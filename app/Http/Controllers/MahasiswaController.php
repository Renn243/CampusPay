<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

//Ini file ubah ke bentuk web.php untuk file view profile.blade dan detail2nya 

class MahasiswaController extends Controller
{
    //tampilkan di profile.blade.php
    public function get()
    {
        $user = auth()->user()->load('mahasiswa');

        if (!$user || !$user->mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan atau belum login');
        }

        return view('pages.mahasiswa.profile', compact('user'));
    }

    //fungsi update edit password/akun
    public function updateAkun(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'username'         => 'sometimes|string|unique:users,username,' . $user->id,
            'email'            => 'sometimes|string|email|unique:users,email,' . $user->id,
            'nama_lengkap'     => 'sometimes|string',
            'password'         => 'sometimes|string|min:8|confirmed',
        ]);

        $data = $request->only(['username', 'email', 'nama_lengkap']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json([
            'message' => 'Akun berhasil diperbarui',
            'user'    => $user,
        ]);
    }

    //fungsi edit profile di button profile.blade.php
    public function updateMahasiswa(Request $request)
    {
        $user = auth()->user();

        if (!$user->mahasiswa) {
            return response()->json(['message' => 'Data mahasiswa tidak ditemukan'], 404);
        }

        $mId = $user->mahasiswa->id_mahasiswa;

        $request->validate([
            'nim'              => 'sometimes|string|unique:mahasiswa,nim,' . $mId . ',id_mahasiswa',
            'nama_mahasiswa'   => 'sometimes|string',
            'tanggal_lahir'    => 'sometimes|date',
            'agama'            => 'sometimes|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu,Lainnya',
            'fakultas'         => 'sometimes|in:teknik,ekonomi,kedokteran,hukum,fisip',
            'program_studi'    => 'sometimes|in:teknik informatika,teknik sipil,teknik elektro',
            'angkatan'         => 'sometimes|in:2023,2022,2021,2020',
            'alamat'           => 'sometimes|string',
            'status'           => 'sometimes|in:aktif,non-aktif',
        ]);

        $user->mahasiswa->update(
            $request->only([
                'nim',
                'nama_mahasiswa',
                'tanggal_lahir',
                'agama',
                'fakultas',
                'program_studi',
                'angkatan',
                'alamat',
                'status'
            ])
        );

        return response()->json([
            'message'   => 'Data mahasiswa berhasil diperbarui',
            'mahasiswa' => $user->mahasiswa,
        ]);
    }
}
