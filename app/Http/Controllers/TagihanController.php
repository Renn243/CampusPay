<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Mahasiswa;
use \App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\TransaksiCreated;
use Illuminate\Support\Facades\Mail;

class TagihanController extends Controller
{
    // Get all tagihan
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $search = $request->query('search');

        $query = Tagihan::query();

        if ($search) {
            $query->where('nama_tagihan', 'like', '%' . $search . '%');
        }

        $tagihan = $query->paginate($perPage)->appends($request->all());

        return view('pages.admin.tagihan', compact('tagihan'));
    }

    // Detail Tagihan
    public function show($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        return view('pages.admin.detailTagihan', compact('tagihan'));
    }

    // Buat tagihan
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
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $tagihan = Tagihan::create($request->only([
            'nama_tagihan',
            'kategori',
            'nominal',
            'tanggal_mulai',
            'tanggal_batas',
            'angkatan'
        ]));

        $mahasiswas = Mahasiswa::where('angkatan', $request->angkatan)->get();

        foreach ($mahasiswas as $mhs) {
            $tagihan->tagihanMahasiswa()->create([
                'id_mahasiswa' => $mhs->id_mahasiswa,
                'status'       => 'belum bayar',
            ]);

            $transaksi = Transaksi::create([
                'id_mahasiswa' => $mhs->id_mahasiswa,
                'id_tagihan' => $tagihan->id_tagihan,
                'jumlah_bayar' => $tagihan->nominal,
                'tanggal_bayar' => null,
            ]);

            Mail::to($mhs->user->email)->send(new TransaksiCreated($transaksi));
        }

        return redirect()->back()->with('success', 'Berhasil tambah tagihan');
    }

    // Update tagihan admin
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
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
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

    // Hapus Tagihan Admin
    public function destroy($id)
    {
        $tagihan = Tagihan::find($id);

        if (!$tagihan) {
            return redirect()->back()->with('error', 'Tagihan tidak ditemukan');
        }

        $tagihan->delete();

        return redirect()->back()->with('success', 'Berhasil hapus tagihan');
    }
}
