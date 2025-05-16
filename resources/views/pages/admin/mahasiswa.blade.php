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
                        <div class="search-box me-2">
                            <i class="bi bi-search"></i>
                            <input type="text" class="form-control" placeholder="Cari mahasiswa...">
                        </div>
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
                        <tr>
                            <td>123456789</td>
                            <td>
                                <h6 class="mb-0">Budi Santoso</h6>
                                <small class="text-muted">budi.santoso@email.com</small>
                            </td>
                            <td>Teknik</td>
                            <td>Teknik Informatika</td>
                            <td>2020</td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/admin/detailMahasiswa" class="text-decoration-none">
                                        <button class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>123456790</td>
                            <td>

                                <h6 class="mb-0">Siti Nuraini</h6>
                                <small class="text-muted">siti.nuraini@email.com</small>
                            </td>
                            <td>Ekonomi</td>
                            <td>Akuntansi</td>
                            <td>2021</td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/admin/detailMahasiswa" class="text-decoration-none">
                                        <button class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>123456791</td>
                            <td>
                                <h6 class="mb-0">Ahmad Rizki</h6>
                                <small class="text-muted">ahmad.rizki@email.com</small>

                            </td>
                            <td>Teknik</td>
                            <td>Teknik Sipil</td>
                            <td>2019</td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/admin/detailMahasiswa" class="text-decoration-none">
                                        <button class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>123456792</td>
                            <td>
                                <h6 class="mb-0">Dewi Lestari</h6>
                                <small class="text-muted">dewi.lestari@email.com</small>
                            </td>
                            <td>Kedokteran</td>
                            <td>Kedokteran Umum</td>
                            <td>2022</td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/admin/detailMahasiswa" class="text-decoration-none">
                                        <button class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>123456793</td>
                            <td>
                                <h6 class="mb-0">Rudi Hartono</h6>
                                <small class="text-muted">rudi.hartono@email.com</small>
                            </td>
                            <td>Hukum</td>
                            <td>Ilmu Hukum</td>
                            <td>2020</td>
                            <td><span class="badge bg-secondary">Non-Aktif</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/admin/detailMahasiswa" class="text-decoration-none">
                                        <button class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center align-items-center mt-3">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-end mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
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
                <form id="addMahasiswaForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nim" class="form-label required-field">NIM</label>
                            <input type="text" class="form-control" id="nim" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nama" class="form-label required-field">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label required-field">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telepon" class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control" id="telepon">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fakultas" class="form-label required-field">Fakultas</label>
                            <select class="form-select" id="fakultas" required>
                                <option value="" selected disabled>Pilih Fakultas</option>
                                <option value="teknik">Teknik</option>
                                <option value="ekonomi">Ekonomi</option>
                                <option value="kedokteran">Kedokteran</option>
                                <option value="hukum">Hukum</option>
                                <option value="fisip">FISIP</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="prodi" class="form-label required-field">Program Studi</label>
                            <select class="form-select" id="prodi" required>
                                <option value="" selected disabled>Pilih Program Studi</option>
                                <option value="informatika">Teknik Informatika</option>
                                <option value="sipil">Teknik Sipil</option>
                                <option value="elektro">Teknik Elektro</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="angkatan" class="form-label required-field">Angkatan</label>
                            <select class="form-select" id="angkatan" required>
                                <option value="" selected disabled>Pilih Angkatan</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label required-field">Status</label>
                            <select class="form-select" id="status" required>
                                <option value="aktif" selected>Aktif</option>
                                <option value="nonaktif">Non-Aktif</option>
                                <option value="cuti">Cuti</option>
                                <option value="lulus">Lulus</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="saveMahasiswa()">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection