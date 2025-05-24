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
                            <p><i class="bi bi-geo-alt me-2 text-secondary"></i><strong>Tempat Lahir:</strong><br> {{ $mahasiswa->tempat_lahir }}</p>
                            <p><i class="bi bi-gender-ambiguous me-2 text-secondary"></i><strong>Jenis Kelamin:</strong><br> {{ $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><i class="bi bi-bookmark-star-fill me-2 text-secondary"></i><strong>Agama:</strong><br> {{ ucfirst($mahasiswa->agama) }}</p>
                            <p><i class="bi bi-geo-alt-fill me-2 text-secondary"></i><strong>Alamat:</strong><br> {{ $mahasiswa->alamat }}</p>
                            <p><i class="bi bi-telephone-fill me-2 text-secondary"></i><strong>No. Telp:</strong><br> {{ $mahasiswa->no_telp }}</p>
                            <p><i class="bi bi-envelope-fill me-2 text-secondary"></i><strong>Email:</strong><br> {{ $mahasiswa->user->email }}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <!-- Tombol buka modal -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editMahasiswaModal">
                            <i class="bi bi-pencil-square me-2"></i> Edit Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Mahasiswa -->
<div class="modal fade" id="editMahasiswaModal" tabindex="-1" aria-labelledby="editMahasiswaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.updateProfileMahasiswa', $mahasiswa->id_mahasiswa) }}" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="editMahasiswaModalLabel">Edit Data Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" value="{{ $mahasiswa->nama_mahasiswa }}">
                    </div>
                    <div class="col-md-6">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" value="{{ $mahasiswa->nim }}">
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ \Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->format('Y-m-d') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ $mahasiswa->tempat_lahir }}">
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" {{ $mahasiswa->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $mahasiswa->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="agama" class="form-label">Agama</label>
                        <select class="form-control" id="agama" name="agama" required>
                            <option value="">Pilih Agama</option>
                            <option value="islam" {{ strtolower($mahasiswa->agama) == 'islam' ? 'selected' : '' }}>Islam</option>
                            <option value="kristen" {{ strtolower($mahasiswa->agama) == 'kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="katolik" {{ strtolower($mahasiswa->agama) == 'katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="hindu" {{ strtolower($mahasiswa->agama) == 'hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="buddha" {{ strtolower($mahasiswa->agama) == 'buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="konghucu" {{ strtolower($mahasiswa->agama) == 'konghucu' ? 'selected' : '' }}>Konghucu</option>
                            <option value="lainnya" {{ strtolower($mahasiswa->agama) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="2">{{ $mahasiswa->alamat }}</textarea>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label for="no_telp" class="form-label">No. Telp</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ $mahasiswa->no_telp }}">
                    </div>
                    <div class="col-md-6">
                        <label for="angkatan" class="form-label">Angkatan</label>
                        <select class="form-control" id="angkatan" name="angkatan" required>
                            <option value="">Pilih Angkatan</option>
                            <option value="2023" {{ $mahasiswa->angkatan == '2023' ? 'selected' : '' }}>2023</option>
                            <option value="2022" {{ $mahasiswa->angkatan == '2022' ? 'selected' : '' }}>2022</option>
                            <option value="2021" {{ $mahasiswa->angkatan == '2021' ? 'selected' : '' }}>2021</option>
                            <option value="2020" {{ $mahasiswa->angkatan == '2020' ? 'selected' : '' }}>2020</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label for="fakultas" class="form-label">Fakultas</label>
                        <select class="form-control" id="fakultas" name="fakultas" required>
                            <option value="">Pilih Fakultas</option>
                            <option value="teknik" {{ $mahasiswa->fakultas == 'teknik' ? 'selected' : '' }}>Teknik</option>
                            <option value="ekonomi" {{ $mahasiswa->fakultas == 'ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                            <option value="kedokteran" {{ $mahasiswa->fakultas == 'kedokteran' ? 'selected' : '' }}>Kedokteran</option>
                            <option value="hukum" {{ $mahasiswa->fakultas == 'hukum' ? 'selected' : '' }}>Hukum</option>
                            <option value="fisip" {{ $mahasiswa->fakultas == 'fisip' ? 'selected' : '' }}>FISIP</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="program_studi" class="form-label">Program Studi</label>
                        <select class="form-control" id="program_studi" name="program_studi" required>
                            <option value="">Pilih Program Studi</option>
                            <option value="teknik informatika" {{ $mahasiswa->program_studi == 'teknik informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                            <option value="teknik sipil" {{ $mahasiswa->program_studi == 'teknik sipil' ? 'selected' : '' }}>Teknik Sipil</option>
                            <option value="teknik elektro" {{ $mahasiswa->program_studi == 'teknik elektro' ? 'selected' : '' }}>Teknik Elektro</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="">Status</option>
                            <option value="Aktif" {{ $mahasiswa->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Tidak Aktif" {{ $mahasiswa->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@endsection