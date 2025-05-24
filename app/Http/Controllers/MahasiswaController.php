<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    //Get all mahasiswa
    public function get()
    {
        $user = auth()->user()->load('mahasiswa');

        if (!$user || !$user->mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan atau belum login');
        }

        return view('pages.mahasiswa.profile', compact('user'));
    }

    //Update password
    public function updateAkun(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'password'         => 'sometimes|string|min:8|confirmed'
        ]);

        $data = $request->only(['password']);

        $data['password'] = Hash::make($request->password);

        $user->update($data);

        return redirect()->back()->with('success', 'Password berhasi diperbarui');
    }

    // Edit profile mahasiswa
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

        return redirect()->back()->with('success', 'Data mahasiswa berhasi diperbarui');
    }
}
