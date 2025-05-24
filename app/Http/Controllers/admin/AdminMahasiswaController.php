<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Mahasiswa;

class AdminMahasiswaController extends Controller
{

    //Get all mahasiswa (Admin)
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $search = $request->query('search');

        $query = Mahasiswa::query();

        if ($search) {
            $query->where('nama_mahasiswa', 'like', '%' . $search . '%');
        }

        $listMahasiswa = $query->paginate($perPage)->withQueryString();

        return view('pages.admin.mahasiswa', compact('listMahasiswa', 'search'));
    }

    //Detail mahasiswa (Admin)
    public function show($id)
    {

        $mahasiswa = Mahasiswa::with(['user'])
            ->find($id);

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan');
        }

        return view('pages.admin.detailMahasiswa', compact('mahasiswa'));
    }

    // Update profile mahasiwa (Admin)
    public function updateProfileMahasiswa(Request $request, $id)
    {
        $validated = $request->validate([
            'status'         => 'required|in:aktif,non-aktif',
            'nama_mahasiswa' => 'nullable|string|max:255',
            'tanggal_lahir'  => 'nullable|date',
            'jenis_kelamin'  => 'nullable|in:L,P',
            'agama'          => 'nullable|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu,Lainnya',
            'tempat_lahir'   => 'nullable|string|max:100',
            'no_telp'        => 'nullable|string|max:20',
        ]);

        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan');
        }

        $mahasiswa->update(array_filter($validated, function ($value) {
            return !is_null($value);
        }));

        return redirect()->back()->with('success', 'Profil mahasiswa berhasil diperbarui');
    }
}
