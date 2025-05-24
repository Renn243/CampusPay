<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;
use App\Models\TagihanMahasiswa;
use App\Models\Mahasiswa;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function indexBeranda()
    {
        $pengumuman = Pengumuman::orderBy('tanggal_mulai', 'desc')->first();

        $id_mahasiswa = Auth::user()->mahasiswa->id_mahasiswa ?? null;

        if ($id_mahasiswa) {
            $tagihan = TagihanMahasiswa::with('tagihan')
                ->where('id_mahasiswa', $id_mahasiswa)
                ->where('status', 'belum bayar')
                ->first();
        } else {
            $tagihan = null;
        }

        return view('pages.mahasiswa.beranda', compact('pengumuman', 'tagihan'));
    }

    public function index()
    {
        $totalMahasiswa = Mahasiswa::count();

        $totalPembayaran = DB::table('transaksi')
            ->join('tagihan_mahasiswa', 'transaksi.id_mahasiswa', '=', 'tagihan_mahasiswa.id_mahasiswa')
            ->where('tagihan_mahasiswa.status', 'lunas')
            ->sum('transaksi.jumlah_bayar');

        $totalTagihanPending = TagihanMahasiswa::where('status', 'pending')->count();

        $totalTagihanDitolak = TagihanMahasiswa::where('status', 'ditolak')->count();

        $transaksiTerbaru = TagihanMahasiswa::with(['mahasiswa', 'tagihan'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $pengumumanTerbaru = Pengumuman::orderBy('tanggal_mulai', 'desc')
            ->limit(3)
            ->get();

        return view('pages.admin.dashboard', compact(
            'totalMahasiswa',
            'totalPembayaran',
            'totalTagihanPending',
            'totalTagihanDitolak',
            'transaksiTerbaru',
            'pengumumanTerbaru'
        ));
    }
}
