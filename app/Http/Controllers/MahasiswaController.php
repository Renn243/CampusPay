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
            'password'         => 'sometimes|string|min:8|confirmed'
        ]);

        $data = $request->only(['password']);

        $data['password'] = Hash::make($request->password);

        $user->update($data);

        return response()->json([
            'message' => 'Password berhasil diperbarui',
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
            'tanggal_lahir'    => 'sometimes|date',
            'alamat'           => 'sometimes|string',
            'no_telp'          => 'sometimes|string',
        ]);

        $user->mahasiswa->update(
            $request->only([
                'tanggal_lahir',
                'alamat',
                'no_telp',
            ])
        );

        return response()->json([
            'message'   => 'Data mahasiswa berhasil diperbarui',
            'mahasiswa' => $user->mahasiswa,
        ]);
    }
}
