<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


//Ini file ubah ke bentuk web.php untuk file view login.blade (fungsi disini yang diubah untuk login saja)
//pindahkan yang register ke adminMahasiswaController versi web.php (klw bisa buat file controller baru, copas saja terus ubah)
//yang dashboard admin sama mahasiswa nanti dibahas di discord

class AuthController extends Controller
{

    //ini untuk tambah mahasiswa
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // USER fields
            'username'       => 'required|string|unique:users',
            'password'       => 'required|string|min:8|confirmed',
            'email'          => 'required|string|email|unique:users',
            'nama_lengkap'   => 'required|string',

            // MAHASISWA fields
            'nim'            => 'required|string|unique:mahasiswa,nim',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required|in:L,P',
            'tempat_lahir'   => 'required|string',
            'not_telp'       => 'required|string|max:16',
            'agama'          => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu,Lainnya',
            'fakultas'       => 'required|in:teknik,ekonomi,kedokteran,hukum,fisip',
            'program_studi'  => 'required|in:teknik informatika,teknik sipil,teknik elektro',
            'angkatan'       => 'required|in:2023,2022,2021,2020',
            'alamat'         => 'required|string',
            'status'         => 'sometimes|in:aktif,non-aktif',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // Create user
        $user = User::create([
            'username'       => $request->username,
            'password'       => Hash::make($request->password),
            'email'          => $request->email,
            'nama_lengkap'   => $request->nama_lengkap,
        ]);

        // Create mahasiswa linked to user
        $mahasiswa = Mahasiswa::create([
            'id_user'         => $user->id,
            'nim'             => $request->nim,
            'nama_mahasiswa'  => $request->nama_lengkap,
            'tanggal_lahir'   => $request->tanggal_lahir,
            'jenis_kelamin'   => $request->jenis_kelamin,
            'tempat_lahir'    => $request->tempat_lahir,
            'no_telp'         => $request->no_telp,
            'agama'           => $request->agama,
            'fakultas'        => $request->fakultas,
            'program_studi'   => $request->program_studi,
            'angkatan'        => $request->angkatan,
            'alamat'          => $request->alamat,
            'status'          => $request->status ?? 'aktif',
        ]);

        return redirect()->back()->with('success', 'Registrasi berhasil!');
    }

    public function showLoginForm()
    {
        return view('layouts.auth');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('beranda');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'sometimes|string|unique:users,username,' . $id,
            'email' => 'sometimes|string|email|unique:users,email,' . $id,
            'nama_lengkap' => 'sometimes|string',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only('username', 'email', 'nama_lengkap'));

        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }
}
