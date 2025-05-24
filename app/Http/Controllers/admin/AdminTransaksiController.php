<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Transaksi;
use App\Models\TagihanMahasiswa;
use App\Mail\VerifyTransaction;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AdminTransaksiController extends Controller
{
    //Get all pembayaran mahasiswa (Admin)
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $search = $request->query('search');

        $query = TagihanMahasiswa::with(['mahasiswa', 'tagihan']);

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

    //Detail pembayaran mahasiswa (Admin)
    public function show($id_mahasiswa, $id_tagihan)
    {
        $transaksi = Transaksi::where('id_tagihan', $id_tagihan)
            ->where('id_mahasiswa', $id_mahasiswa)
            ->with(['mahasiswa', 'tagihan'])
            ->first();

        $tagihan = TagihanMahasiswa::where('id_tagihan', $id_tagihan)
            ->where('id_mahasiswa', $id_mahasiswa)
            ->first();

        if (!$transaksi) {
            return redirect()->back()->withErrors('Transaksi tidak ditemukan.');
        }

        return view('pages.admin.detailPembayaran', compact('transaksi', 'tagihan'));
    }

    // Update status transaksi, status: lunas (Admin)
    public function updateStatusPembayaran(Request $request, $id)
    {
        $transaksiById = TagihanMahasiswa::with(['mahasiswa', 'tagihan'])
            ->where('id', $id)
            ->first();

        if (!$transaksiById) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
        }

        $transaksiById->update([
            'status'        => $request->status,
        ]);

        Mail::to($transaksiById->mahasiswa->user->email)->send(new VerifyTransaction($transaksiById));

        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui');
    }

    // Update status transaksi mahasiswa, status: ditolak (Admin)
    public function updateStatusPembayaranTolak(Request $request, $id)
    {
        $transaksiById = TagihanMahasiswa::with(['mahasiswa', 'tagihan'])
            ->where('id', $id)
            ->first();

        if (!$transaksiById) {
            Log::warning("Transaksi tidak ditemukan dengan ID: {$id}");
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
        }

        $updateResult = $transaksiById->update([
            'status' => $request->status,
            'alasan' => $request->alasan,
        ]);

        Mail::to($transaksiById->mahasiswa->user->email)->send(new VerifyTransaction($transaksiById));

        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui');
    }
}
