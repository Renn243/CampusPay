<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;

class AdminPengumumanController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $search = $request->query('search');

        $query = Pengumuman::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%');
            });
        }

        $pengumuman = $query->paginate($perPage)->appends($request->all());

        return view('pages.admin.pengumuman', compact('pengumuman'));
    }

    public function show($id)
    {
        $pengumumanById = Pengumuman::where('id_pengumuman', $id)->first();

        if (!$pengumumanById) {
            return redirect()->route('pages.admin.pengumuman')->with('error', 'Pengumuman tidak ditemukan');
        }

        return view('pages.admin.detailPengumuman', compact('pengumumanById'));
    }

    public function create()
    {
        return view('pages.admin.createPengumuman');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'deskripsi' => 'required|string',
        ]);

        Pengumuman::create($validated);

        return redirect()->back()->with('success', 'Pengumuman berhasil dibuat');
    }

    public function destroy($id)
    {
        $pengumuman = Pengumuman::find($id);

        if (!$pengumuman) {
            return redirect()->back()->with('error', 'Pengumuman tidak ditemukan');
        }

        $pengumuman->delete();

        return redirect()->back()->with('success', 'Pengumuman berhasil dibuat');
    }

    public function update(Request $request, $id)
    {
        $pengumuman = Pengumuman::find($id);

        if (!$pengumuman) {
            return redirect()->back()->with('error', 'Pengumuman tidak ditemukan');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'deskripsi' => 'required|string',
        ]);

        $pengumuman->update($validated);

        return redirect()->back()->with('success', 'Pengumuman berhasil diperbarui');
    }
}
