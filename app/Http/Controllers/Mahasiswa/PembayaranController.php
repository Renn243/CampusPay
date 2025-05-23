<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Transaksi;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use PDF;

class PembayaranController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->mahasiswa) {
            return redirect()->back()->withErrors('Mahasiswa tidak ditemukan atau belum login.');
        }

        $mahasiswa = $user->mahasiswa;
        $perPage = $request->query('per_page', 10);

        $transaksi = Transaksi::with(['mahasiswa', 'tagihan'])
            ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return view('pages.mahasiswa.riwayat', compact('transaksi'));
    }

    public function indexPembayaran(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->mahasiswa) {
            return redirect()->back()->withErrors('Mahasiswa tidak ditemukan atau belum login.');
        }

        $mahasiswa = $user->mahasiswa;
        $perPage = $request->query('per_page', 10);

        $transaksi = Transaksi::with(['mahasiswa', 'tagihan'])
            ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return view('pages.mahasiswa.pembayaran', compact('transaksi'));
    }

    public function show($id_transaksi)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        $transaksi = Transaksi::where('id_transaksi', $id_transaksi)
            ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->with(['mahasiswa', 'tagihan'])
            ->first();

        if (!$transaksi) {
            return redirect()->back()->withErrors('Transaksi tidak ditemukan.');
        }

        return view('pages.mahasiswa.detailPembayaran', compact('transaksi'));
    }

    public function transaksiWithMidtrans(Request $request, $id_transaksi)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        \Log::info("Mulai transaksiWithMidtrans untuk id_transaksi: $id_transaksi, user_id: {$user->id}");

        $transaksi = Transaksi::where('id_transaksi', $id_transaksi)
            ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->where('status', 'pending')
            ->first();

        if (!$transaksi) {
            \Log::warning("Transaksi tidak ditemukan atau sudah diproses: id_transaksi=$id_transaksi, id_mahasiswa={$mahasiswa->id_mahasiswa}");
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan atau sudah diproses.'
            ], 404);
        }

        if (!$transaksi->order_id) {
            $transaksi->order_id = 'ORDER-' . time();
            $transaksi->save();
            \Log::info("Order ID baru dibuat: {$transaksi->order_id}");
        }

        $payload = [
            'transaction_details' => [
                'order_id'     => $transaksi->order_id,
                'gross_amount' => $transaksi->jumlah_bayar,
            ],
            'customer_details' => [
                'first_name' => $mahasiswa->nama_mahasiswa,
                'email'      => $user->email,
            ],
        ];

        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        try {
            $snapToken = Snap::getSnapToken($payload);

            $transaksi->snap_token = $snapToken;
            $transaksi->save();

            \Log::info("Snap token berhasil dibuat untuk order_id {$transaksi->order_id}");

            return response()->json([
                'success' => true,
                'message' => 'Snap token berhasil dibuat.',
                'snap_token' => $snapToken,
            ]);
        } catch (\Exception $e) {
            \Log::error("Gagal membuat transaksi Midtrans untuk order_id {$transaksi->order_id}: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat transaksi Midtrans.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateStatusTransaksi($id_transaksi)
    {
        \Log::info('Mulai updateStatusTransaksi untuk id_transaksi: ' . $id_transaksi);

        $transaksi = Transaksi::where('id_transaksi', $id_transaksi)
            ->with(['mahasiswa', 'tagihan'])
            ->first();

        if (!$transaksi || !$transaksi->order_id) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan atau order_id kosong.'
            ], 404);
        }

        $orderId = trim($transaksi->order_id);
        \Log::info('Order ID transaksi: ' . $orderId);

        try {
            $status = Transaction::status($orderId);
            \Log::info('Status transaksi dari Midtrans:', (array)$status);

            $updateData = [];

            if (isset($status->transaction_status)) {
                \Log::info('Status transaksi: ' . $status->transaction_status);

                switch ($status->transaction_status) {
                    case 'settlement':
                        $updateData['status'] = 'sukses';
                        $updateData['tanggal_bayar'] = now();
                        $updateData['metode_transaksi'] = $status->payment_type ?? null;

                        $pdf = PDF::loadView('emails.tanda_terima', [
                            'transaksi' => $transaksi,
                            'status' => $status
                        ]);

                        $fileName = $orderId . '.pdf';
                        $folderPath = public_path('receipts');
                        if (!file_exists($folderPath)) {
                            mkdir($folderPath, 0755, true);
                        }
                        $filePath = $folderPath . '/' . $fileName;
                        $pdf->save($filePath);
                        \Log::info('PDF tanda terima berhasil disimpan: ' . $filePath);

                        $updateData['foto_bukti_transaksi'] = 'receipts/' . $fileName;
                        break;

                    case 'pending':
                        $updateData['status'] = 'pending';
                        break;

                    case 'cancel':
                    case 'expire':
                    case 'failure':
                        $updateData['status'] = 'gagal';
                        break;
                }

                $transaksi->update($updateData);
                \Log::info('Update database berhasil.', $updateData);

                return response()->json([
                    'success' => true,
                    'message' => 'Status transaksi berhasil diperbarui.',
                    'data' => $updateData,
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Status transaksi dari Midtrans tidak lengkap.'
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Midtrans API error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil status transaksi dari Midtrans.'
            ], 500);
        }
    }
}
