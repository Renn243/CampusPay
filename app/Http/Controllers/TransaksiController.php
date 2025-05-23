<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Transaksi;
use App\Models\Mahasiswa;
use Midtrans\Config;
use Midtrans\Transaction;
use Midtrans\Snap;
use PDF;

//Ini file ubah ke bentuk web.php untuk file view riwayat.blade/pembayaran.blade dan detail2nya (nanti tambah logic unduh bukti pembayaran)

class TransaksiController extends Controller
{
    // Tampilkan semua transaksi milik mahasiswa yang sedang login (lokasi route bisa pembayaran dan riwayat pembayaran)
    public function index(Request $request)
    {
        $user = auth()->user();

        // Pastikan user adalah mahasiswa
        if (!$user || !$user->mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan atau belum login');
        }

        $mahasiswa = $user->mahasiswa;

        // Ambil jumlah data per halaman dari query string, default 10
        $perPage = $request->query('per_page', 10);

        // Ambil semua transaksi milik mahasiswa yang sedang login
        $transaksi = Transaksi::with(['mahasiswa', 'tagihan'])
            ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return view('pages.mahasiswa.riwayat', compact('transaksi'));
    }


    // Tampilkan detail transaksi tertentu
    public function show($id_transaksi)
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;

        $transaksi = Transaksi::where('id_transaksi', $id_transaksi)
            ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->with(['mahasiswa', 'tagihan'])
            ->first();

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
        }

        return view('pages.mahasiswa.detailPembayaran', compact('transaksi'));
    }

    public function transaksiWithMidtrans(Request $request, $id_transaksi)
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;

        $transaksi = Transaksi::where('id_transaksi', $id_transaksi)
            ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->where('status', 'pending')
            ->first();

        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan atau sudah diproses'], 404);
        }

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        if (!$transaksi->order_id) {
            $orderId = 'ORDER-' . time();
            $transaksi->order_id = $orderId;
            $saved = $transaksi->save();
            if (!$saved) {
                return response()->json(['message' => 'Gagal menyimpan order_id'], 500);
            }
        } else {
            $orderId = $transaksi->order_id;
        }

        $payload = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $transaksi->jumlah_bayar,
            ],
            'customer_details' => [
                'first_name' => $mahasiswa->nama_mahasiswa,
                'email'      => $user->email,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($payload);

            return response()->json([
                'success'     => true,
                'snap_token'  => $snapToken,
                'order_id'    => $orderId,
                'id' => $transaksi->id_transaksi
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat transaksi Midtrans',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    //saat pembayaran sudah dilakukan panggil fungsi ini di file view
    public function updateStatusTransaksi($id_transaksi)
    {
        $transaksi = Transaksi::where('id_transaksi', $id_transaksi)->with(['mahasiswa', 'tagihan'])->first();

        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan atau order_id kosong'], 404);
        }

        $orderId = trim($transaksi->order_id);

        // Midtrans config
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = filter_var(env('MIDTRANS_IS_PRODUCTION', false), FILTER_VALIDATE_BOOLEAN);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        try {
            $status = Transaction::status($orderId);
            $updateData = [];

            if (isset($status->transaction_status)) {
                if ($status->transaction_status === 'settlement') {
                    $updateData['status'] = 'sukses';
                    $updateData['tanggal_bayar'] = now();
                    $updateData['metode_transaksi'] = $status->payment_type ?? null;

                    $pdf = PDF::loadView('emails.tanda_terima', [
                        'transaksi' => $transaksi,
                        'status'    => $status
                    ]);

                    // Lokasi folder
                    $folderPath = public_path('receipts');

                    // Nama dan path file
                    $fileName = $orderId . '.pdf';
                    $fileFullPath = $folderPath . '/' . $fileName;

                    // Simpan PDF ke path lokal
                    $pdf->save($fileFullPath);

                    // Simpan relative path ke database, misalnya:
                    $updateData['foto_bukti_transaksi'] = 'receipts/' . $fileName;
                } elseif ($status->transaction_status === 'pending') {
                    $updateData['status'] = 'pending';
                } elseif (in_array($status->transaction_status, ['cancel', 'expire', 'failure'])) {
                    $updateData['status'] = 'gagal';
                }

                $transaksi->update($updateData);

                return response()->json([
                    'success' => true,
                    'message' => 'Status transaksi diperbarui',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Status transaksi dari Midtrans tidak lengkap',
                ], 500);
            }
        } catch (\Exception $e) {
            \Log::error('Midtrans API error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil status transaksi dari Midtrans',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
