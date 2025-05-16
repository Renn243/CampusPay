@extends('layouts.admin')

@section('content')
<div id="mahasiswa-detail">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Detail Mahasiswa</h3>
        <button class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </button>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 id="detail-nama">Uzumaki Naruto</h5>
                    <p class="text-muted" id="detail-nim">NIM: 123456789</p>
                    <div class="d-flex justify-content-center">
                        <span class="badge bg-success me-2">Aktif</span>
                        <span class="badge bg-primary">Semester 7</span>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">Informasi Akademik</div>
                <div class="card-body">
                    <p class="mb-2"><strong>Fakultas:</strong><span id="detail-fakultas">Ilmu Komputer</span></p>
                    <p class="mb-2"><strong>Program Studi:</strong><span id="detail-prodi">Teknik Informatika</span></p>
                    <p class="mb-2"><strong>Angkatan:</strong><span id="detail-angkatan">2020</span></p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Informasi Pribadi</div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Nama Lengkap:</strong><span id="detail-nama-lengkap">Budi Santoso</span></p>
                            <p class="mb-2"><strong>Tempat, Tanggal Lahir:</strong><span id="detail-ttl">Jakarta, 15 Mei 2000</span></p>
                            <p class="mb-2"><strong>Jenis Kelamin:</strong><span id="detail-gender">Laki-laki</span></p>
                            <p class="mb-2"><strong>Agama:</strong> <span id="detail-agama">Islam</span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Email:</strong><span id="detail-email">uzumakinaruto@email.com</span></p>
                            <p class="mb-2"><strong>No. Telepon:</strong><span id="detail-telepon">+62 812-1234-5678</span></p>
                            <p class="mb-2"><strong>Alamat:</strong><span id="detail-alamat">Jl. Semangka</span></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-warning me-2">
                            <i class="bi bi-pencil-square me-2"></i> Edit Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection