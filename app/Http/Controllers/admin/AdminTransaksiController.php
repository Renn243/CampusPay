<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Transaksi;
use App\Models\Mahasiswa;

//Ini file ubah ke bentuk web.php untuk file view admin/pembayaran.blade dan detail2nya


class AdminTransaksiController extends Controller
{
    //data pagination
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $search = $request->query('search');

        $query = Transaksi::with(['mahasiswa', 'tagihan']);

        if ($search) {
            $query->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('nama_mahasiswa', 'like', '%' . $search . '%');
            })->orWhereHas('tagihan', function ($q) use ($search) {
                $q->where('nama_tagihan', 'like', '%' . $search . '%');
            });
        }

        $tagihan = $query->paginate($perPage)->appends($request->all());

        return view('pages.admin.pembayaran', compact('tagihan'));
    }


    // Tampilkan detail transaksi tertentu (pembayaran, rincian, dan info tagihan)
    public function show($id)
    {
        $transaksiById = Transaksi::with(['mahasiswa', 'tagihan'])
            ->where('id_transaksi', $id)
            ->first(); // Ganti dari get() ke first()

        if (!$transaksiById) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        return view('pages.admin.detailPembayaran', compact('transaksiById'));
    }


    // Update status transaksi berdasarkan request status admin (sukses, gagal)
    public function updateStatusPembayaran(Request $request, $id)
    {
        $transaksiById = Transaksi::with(['mahasiswa', 'tagihan'])  // Pastikan relasi 'mahasiswa' dan 'tagihan' sudah didefinisikan
            ->where('id_transaksi', $id)  // Filter berdasarkan id_mahasiswa
            ->first();

        if (!$transaksiById) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
        }

        if ($transaksiById->status === 'sukses') {
            return redirect()->back()->with('error', 'Transaksi sudah dibayar');
        }

        $transaksiById->update([
            'status'        => $request->status,
            'tanggal_bayar' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui');
    }
}
