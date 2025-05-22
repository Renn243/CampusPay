<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Mahasiswa;


//Ini file ubah ke bentuk web.php untuk file view admin/mahasiswa.blade dan detail2nya
//untuk fungsi button Tambah ada di authController.php

class AdminMahasiswaController extends Controller
{

    //menampilkan daftar mahasiswa pagination
    public function index(Request $request)
    {
        // Ambil jumlah per halaman dari query ?per_page=10, default 10
        $perPage = $request->query('per_page', 10);

        $listMahasiswa = Mahasiswa::paginate($perPage);

        return view('pages.admin.mahasiswa', compact('listMahasiswa'));
    }

    // Tampilkan detail transaksi tertentu (pembayaran, rincian, dan info tagihan)
    public function show($id)
    {

        $mahasiswa = Mahasiswa::with(['user'])
            ->find($id);

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan');
        }

        return view('pages.admin.detailMahasiswa', compact('mahasiswa'));
    }

    // Update Profile Mahasiswa di button admin/mahasiswa.blade.php atau detailMahasiswa
    public function updateProfileMahasiswa(Request $request, $id)
    {
        // Validasi input data
        $validated = $request->validate([
            'status'         => 'required|in:aktif,non-aktif',
            'nama_mahasiswa' => 'nullable|string|max:255',
            'tanggal_lahir'  => 'nullable|date',
            'alamat'         => 'nullable|string|max:255',
            'jenis_kelamin'  => 'nullable|in:L,P', // L = Laki-laki, P = Perempuan (ubah sesuai enum Anda)
            'agama'          => 'nullable|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu,Lainnya',
            'tempat_lahir'   => 'nullable|string|max:100',
            'no_telp'        => 'nullable|string|max:20',
        ]);

        // Ambil data mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan');
        }

        // Update semua data valid yang dikirim
        $mahasiswa->update(array_filter($validated, function ($value) {
            return !is_null($value);
        }));

        return redirect()->back()->with('success', 'Profil mahasiswa berhasil diperbarui');
    }
}
