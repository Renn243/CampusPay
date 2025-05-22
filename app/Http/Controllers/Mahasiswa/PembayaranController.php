<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Transaksi;
use App\Models\Mahasiswa;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use PDF;

class TransaksiWebController extends Controller
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
            return redirect()->route('home')->withErrors('Mahasiswa tidak ditemukan atau belum login.');
        }

        $mahasiswa = $user->mahasiswa;
        $perPage = $request->query('per_page', 10);

        $transaksis = Transaksi::with(['mahasiswa', 'tagihan'])
            ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return view('pembayaran', compact('transaksis'));
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
            return redirect()->route('transaksi.index')->withErrors('Transaksi tidak ditemukan.');
        }

        return view('detailPembayaran', compact('transaksi'));
    }

    public function transaksiWithMidtrans(Request $request, $id_transaksi)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        $transaksi = Transaksi::where('id_transaksi', $id_transaksi)
            ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->where('status', 'pending')
            ->first();

        if (!$transaksi) {
            return back()->withErrors('Transaksi tidak ditemukan atau sudah diproses.');
        }

        if (!$transaksi->order_id) {
            $transaksi->order_id = 'ORDER-' . time();
            $transaksi->save();
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

        try {
            $snapToken = Snap::getSnapToken($payload);
            return redirect()
                ->route('transaksi.detail', $id_transaksi)
                ->with('snap_token', $snapToken);
        } catch (\Exception $e) {
            return back()->withErrors('Gagal membuat transaksi Midtrans: ' . $e->getMessage());
        }
    }

    public function updateStatusTransaksi($id_transaksi)
    {
        $transaksi = Transaksi::where('id_transaksi', $id_transaksi)
            ->with(['mahasiswa', 'tagihan'])
            ->first();

        if (!$transaksi || !$transaksi->order_id) {
            return back()->withErrors('Transaksi tidak ditemukan atau order_id kosong.');
        }

        $orderId = trim($transaksi->order_id);

        try {
            $status = Transaction::status($orderId);
            $updateData = [];

            if (isset($status->transaction_status)) {
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
                        $filePath = $folderPath . '/' . $fileName;
                        $pdf->save($filePath);

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

                return back()->with('success', 'Status transaksi berhasil diperbarui.');
            }

            return back()->withErrors('Status transaksi dari Midtrans tidak lengkap.');

        } catch (\Exception $e) {
            Log::error('Midtrans API error: ' . $e->getMessage());
            return back()->withErrors('Gagal mengambil status transaksi dari Midtrans.');
        }
    }
}
