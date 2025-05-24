<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\TagihanMahasiswa;
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
        $search = $request->query('q');

        $transaksi = TagihanMahasiswa::with(['mahasiswa', 'tagihan'])
            ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->when($search, function ($query, $search) {
                $query->whereHas('tagihan', function ($q) use ($search) {
                    $q->where('nama_tagihan', 'like', '%' . $search . '%');
                });
            })
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
        $search = $request->query('q');

        $transaksi = TagihanMahasiswa::with(['mahasiswa', 'tagihan'])
            ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->when($search, function ($query, $search) {
                $query->whereHas('tagihan', function ($q) use ($search) {
                    $q->where('nama_tagihan', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return view('pages.mahasiswa.pembayaran', compact('transaksi'));
    }

    public function show($id_tagihan)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        $transaksi = Transaksi::where('id_tagihan', $id_tagihan)
            ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->with(['mahasiswa', 'tagihan'])
            ->first();

        $tagihan_mahasiswa = TagihanMahasiswa::where('id_tagihan', $id_tagihan)
            ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->with(['mahasiswa', 'tagihan'])
            ->first();

        if (!$transaksi) {
            return redirect()->back()->withErrors('Transaksi tidak ditemukan.');
        }

        return view('pages.mahasiswa.detailPembayaran', compact('transaksi', 'tagihan_mahasiswa'));
    }

    public function transaksiWithMidtrans(Request $request, $id_tagihan)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        \Log::info("Mulai transaksiWithMidtrans untuk id_transaksi: $id_tagihan, user_id: {$user->id}");

        $transaksi = Transaksi::where('id_tagihan', $id_tagihan)
            ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->first();

        if (!$transaksi) {
            \Log::warning("Transaksi tidak ditemukan atau sudah diproses: id_transaksi=$id_tagihan, id_mahasiswa={$mahasiswa->id_mahasiswa}");
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan atau sudah diproses.'
            ], 404);
        }

        $orderId = 'ORDER-' . time();

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

        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        \Log::info('Midtrans Config:', [
            'MIDTRANS_SERVER_KEY' => env('MIDTRANS_SERVER_KEY'),
            'MIDTRANS_IS_PRODUCTION' => env('MIDTRANS_IS_PRODUCTION'),
        ]);

        try {
            $snapToken = Snap::getSnapToken($payload);

            $transaksi->metode_transaksi = "Transfer Bank";
            $transaksi->save();

            return response()->json([
                'success' => true,
                'message' => 'Snap token berhasil dibuat.',
                'snap_token' => $snapToken,
            ]);
        } catch (\Exception $e) {
            \Log::error('Gagal membuat Snap Token: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat transaksi Midtrans.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function uploadBuktiPembayaran(Request $request, $id_transaksi, $id_tagihan)
    {
        // Validasi input
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            // Ambil file dan buat nama unik
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Simpan ke folder public/receipts
            $file->move(public_path('receipts'), $filename);

            // Cari transaksi yang sesuai
            $transaksi = Transaksi::where('id_transaksi', $id_transaksi)
                ->first();

            $tagihan_mahasiswa = TagihanMahasiswa::where('id', $id_tagihan)
                ->first();

            // Jika transaksi tidak ditemukan
            if (!$transaksi) {
                return back()->with('error', 'Transaksi tidak ditemukan.');
            }

            if (!$transaksi->metode_transaksi) {
                $transaksi->metode_transaksi = "tunai";
            }

            // Simpan path gambar dan ubah status
            $transaksi->foto_bukti_transaksi = 'receipts/' . $filename;
            $tagihan_mahasiswa->status = 'pending';
            $transaksi->tanggal_bayar = now();
            $transaksi->save();
            $tagihan_mahasiswa->save();

            return back()->with('success', 'Bukti pembayaran berhasil diupload!')
                ->with('image', $filename);
        } catch (\Exception $e) {
            \Log::error('Upload Bukti Gagal: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengupload bukti pembayaran.');
        }
    }
}
