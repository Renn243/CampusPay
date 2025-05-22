<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Mahasiswa;
use \App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\TransaksiCreated;
use Illuminate\Support\Facades\Mail;

//Ini file ubah ke bentuk web.php untuk file view admin/tagihan.blade dan detail2nya 
class TagihanController extends Controller
{
    /**
     * List semua tagihan.
     */
    public function index(Request $request)
    {
        // Ambil jumlah per halaman dari query ?per_page=10, default 10
        $perPage = $request->query('per_page', 10);

        $tagihan = Tagihan::paginate($perPage);

        return view('pages.admin.tagihan', compact('tagihan'));
    }

    /**
     * Lihat detail satu tagihan.
     */
    public function show($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        return view('pages.admin.detailTagihan', compact('tagihan'));
    }

    /**
     * Buat tagihan baru dan assign ke mahasiswa sesuai angkatan.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_tagihan'    => 'required|string',
            'kategori'        => 'required|in:spp,kkn,ujian,wisuda,lainnya',
            'nominal'         => 'required|numeric',
            'tanggal_mulai'   => 'required|date',
            'tanggal_batas'   => 'required|date|after_or_equal:tanggal_mulai',
            'angkatan' => 'required|in:2023,2022,2021,2020',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        // 1. Buat tagihan
        $tagihan = Tagihan::create($request->only([
            'nama_tagihan',
            'kategori',
            'nominal',
            'tanggal_mulai',
            'tanggal_batas',
            'angkatan'
        ]));

        // 2. Ambil mahasiswa sesuai angkatan
        $mahasiswas = Mahasiswa::where('angkatan', $request->angkatan)->get();

        foreach ($mahasiswas as $mhs) {
            // 3a. Tambah entri ke tabel tagihan_mahasiswa
            $tagihan->tagihanMahasiswa()->create([
                'id_mahasiswa' => $mhs->id_mahasiswa,
                'status'       => 'belum bayar',
            ]);

            // 3b. Tambah entri ke tabel transaksi (pending)
            $transaksi = Transaksi::create([
                'id_mahasiswa' => $mhs->id_mahasiswa,
                'id_tagihan' => $tagihan->id_tagihan,
                'jumlah_bayar' => $tagihan->nominal,
                'tanggal_bayar' => null,
                'status' => 'pending',
            ]);

            Mail::to($mhs->user->email)->send(new TransaksiCreated($transaksi));
        }

        return redirect()->back()->with('success', 'Berhasil tambah tagihan');
    }

    /**
     * Update data tagihan.
     */
    public function update(Request $request, $id)
    {
        $tagihan = Tagihan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_tagihan'    => 'sometimes|string',
            'kategori'        => 'sometimes|in:spp,kkn,ujian,wisuda,lainnya',
            'nominal'         => 'sometimes|numeric',
            'tanggal_mulai'   => 'sometimes|date',
            'tanggal_batas'   => 'sometimes|date|after_or_equal:tanggal_mulai',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        $tagihan->update($request->only([
            'nama_tagihan',
            'kategori',
            'nominal',
            'tanggal_mulai',
            'tanggal_batas',
            'angkatan_target'
        ]));

        return redirect()->back()->with('success', 'Berhasil update tagihan');
    }

    /**
     * Hapus tagihan (pivot tagihan_mahasiswa akan terhapus cascade).
     */
    public function destroy($id)
    {
        $tagihan = Tagihan::find($id);

        if (!$tagihan) {
            return response()->json([
                'success' => false,
                'message' => 'Tagihan tidak ditemukan'
            ], 404);
        }

        $tagihan->delete();

        return redirect()->back()->with('success', 'Berhasil hapus tagihan');
    }
}
