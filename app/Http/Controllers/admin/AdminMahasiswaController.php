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
            'status'         => 'nullable|in:Aktif,Non-Aktif',
            'nama_mahasiswa' => 'nullable|string',
            'nim'            => 'nullable|string',
            'tanggal_lahir'  => 'nullable|date',
            'jenis_kelamin'  => 'nullable|in:L,P',
            'agama'          => 'nullable|in:islam,kristen,katolik,hindu,buddha,konghucu,lainnya',
            'fakultas'       => 'nullable|in:teknik,ekonomi,kedokteran,hukum,fisip',
            'program_studi'  => 'nullable|in:teknik informatika,teknik sipil,teknik elektro',
            'tempat_lahir'   => 'nullable|string',
            'alamat'         => 'nullable|string',
            'no_telp'        => 'nullable|string|max:20',
        ]);

        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan');
        }

        // Hanya update field yang ada nilai tidak null
        $dataToUpdate = array_filter($validated, fn($value) => !is_null($value));

        if (!empty($dataToUpdate)) {
            $mahasiswa->update($dataToUpdate);
        }

        return redirect()->back()->with('success', 'Profil mahasiswa berhasil diperbarui');
    }
}
