@extends('layouts.admin')

@section('content')
<div id="mahasiswa-detail">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0"><i class="bi bi-person-lines-fill me-2"></i>Detail Mahasiswa</h3>
        <a href="{{ route('admin.listMahasiswa') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <!-- Sidebar Profil -->
        <div class="col-md-4 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="bi bi-person-circle" style="font-size: 4rem;"></i>
                    </div>
                    <h5>{{ $mahasiswa->nama_mahasiswa }}</h5>
                    <p class="text-muted mb-1">NIM: {{ $mahasiswa->nim }}</p>
                    <div class="d-flex justify-content-center mt-2">
                        <span class="badge {{ $mahasiswa->status == 'Aktif' ? 'bg-success' : 'bg-danger' }} me-2">
                            {{ $mahasiswa->status }}
                        </span>
                        <span class="badge bg-primary">Angkatan {{ $mahasiswa->angkatan }}</span>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">Akademik</div>
                <div class="card-body">
                    <p><i class="bi bi-mortarboard-fill me-2 text-primary"></i><strong>Fakultas:</strong><br> {{ $mahasiswa->fakultas }}</p>
                    <p><i class="bi bi-journal-code me-2 text-primary"></i><strong>Program Studi:</strong><br> {{ $mahasiswa->program_studi }}</p>
                </div>
            </div>
        </div>

        <!-- Info Detail -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Informasi Pribadi</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p><i class="bi bi-person-fill me-2 text-secondary"></i><strong>Nama:</strong><br> {{ $mahasiswa->nama_mahasiswa }}</p>
                            <p><i class="bi bi-calendar-event-fill me-2 text-secondary"></i><strong>Tanggal Lahir:</strong><br>
                                {{ \Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><i class="bi bi-geo-alt-fill me-2 text-secondary"></i><strong>Alamat:</strong><br> {{ $mahasiswa->alamat }}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <a href="#" class="btn btn-warning">
                            <i class="bi bi-pencil-square me-2"></i> Edit Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection