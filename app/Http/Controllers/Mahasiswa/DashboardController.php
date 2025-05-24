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
        // 1. Total mahasiswa
        $totalMahasiswa = Mahasiswa::count();

        // 2. Total pembayaran (jumlah bayar dari transaksi yang status disetujui)
        $totalPembayaran = DB::table('transaksi')
            ->join('tagihan_mahasiswa', 'transaksi.id_mahasiswa', '=', 'tagihan_mahasiswa.id_mahasiswa')
            ->where('tagihan_mahasiswa.status', 'lunas')
            ->sum('transaksi.jumlah_bayar');

        // 3. Total tagihan pending (di tabel tagihan_mahasiswa)
        $totalTagihanPending = TagihanMahasiswa::where('status', 'pending')->count();

        // 4. Total tagihan ditolak (di tabel tagihan_mahasiswa)
        $totalTagihanDitolak = TagihanMahasiswa::where('status', 'ditolak')->count();

        // 5. 5 transaksi terbaru (relasi mahasiswa optional)
        $transaksiTerbaru = TagihanMahasiswa::with(['mahasiswa', 'tagihan'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // 6. 3 pengumuman terbaru
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
