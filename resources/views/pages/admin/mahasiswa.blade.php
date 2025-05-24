@extends('layouts.admin')

@section('content')
<div id="mahasiswa">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0" id="page-title">Mahasiswa</h2>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0">Daftar Mahasiswa</h5>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-md-end">
                        <form method="GET" action="{{ route('admin.listMahasiswa') }}" class="d-flex">
                            <div class="search-box me-2 position-relative">
                                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-2 text-muted"></i>
                                <input
                                    type="text"
                                    name="search"
                                    class="form-control ps-5"
                                    placeholder="Cari mahasiswa..."
                                    value="{{ request('search') }}">
                            </div>
                        </form>

                        <button class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addMahasiswaModal">
                            <i class="bi bi-plus-lg"></i> Tambah
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Fakultas</th>
                            <th>Program Studi</th>
                            <th>Angkatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($listMahasiswa as $mhs)
                        <tr>
                            <td>{{ $mhs['nim'] }}</td>
                            <td>
                                <h6 class="mb-0">{{ $mhs['nama_mahasiswa'] }}</h6>
                                <small class="text-muted">{{ $mhs['nim'] }}@email.com</small>
                            </td>
                            <td>{{ $mhs['fakultas'] }}</td>
                            <td>{{ $mhs['program_studi'] }}</td>
                            <td>{{ $mhs['angkatan'] }}</td>
                            <td>
                                @if($mhs['status'] === 'aktif')
                                <span class="badge bg-success">Aktif</span>
                                @else
                                <span class="badge bg-secondary">Non-Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.detailMahasiswa', $mhs['id_mahasiswa']) }}" class="text-decoration-none">
                                        <button class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Data mahasiswa tidak tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $listMahasiswa->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<!-- Add Mahasiswa Modal -->
<div class="modal fade" id="addMahasiswaModal" tabindex="-1" aria-labelledby="addMahasiswaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMahasiswaModalLabel">Tambah Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('admin.register') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="username" class="form-label required-field">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label required-field">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nama_lengkap" class="form-label required-field">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                        </div>
                        <div class="col-md-6">
                            <label for="no_telp" class="form-label required-field">No. Telepon</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label required-field">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="agama" class="form-label required-field">Agama</label>
                            <select class="form-select" id="agama" name="agama" required>
                                <option value="" selected disabled>Pilih Agama</option>
                                <option value="islam">Islam</option>
                                <option value="kristen">Kristen</option>
                                <option value="katolik">Katolik</option>
                                <option value="hindu">Hindu</option>
                                <option value="buddha">Buddha</option>
                                <option value="konghucu">Konghucu</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nim" class="form-label required-field">NIM</label>
                            <input type="nim" class="form-control" id="nim" name="nim" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label required-field">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fakultas" class="form-label required-field">Fakultas</label>
                            <select class="form-select" id="fakultas" name="fakultas" required>
                                <option value="" selected disabled>Pilih Fakultas</option>
                                <option value="teknik">Teknik</option>
                                <option value="ekonomi">ekonomi</option>
                                <option value="kedokteran">kedokteran</option>
                                <option value="hukum">hukum</option>
                                <option value="fisip">fisip</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="prodi" class="form-label required-field">Program Studi</label>
                            <select class="form-select" id="program_studi" name="program_studi" required>
                                <option value="" selected disabled>Pilih Program Studi</option>
                                <option value="teknik informatika">Teknik Informatika</option>
                                <option value="teknik sipil">Teknik Sipil</option>
                                <option value="teknik elektro">Teknik Elektro</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="angkatan" class="form-label required-field">Angkatan</label>
                            <select class="form-select" id="angkatan" name="angkatan" required>
                                <option value="" selected disabled>Pilih Angkatan</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label required-field">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="aktif" selected>Aktif</option>
                                <option value="non-aktif">Non-Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection