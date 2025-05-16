@extends('layouts.admin')

@section('content')
<div id="tagihan">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0" id="page-title">Tagihan</h2>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0">Kelola Jadwal Tagihan</h5>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-md-end">
                        <div class="search-box me-2">
                            <i class="bi bi-search"></i>
                            <input type="text" class="form-control" placeholder="Cari tagihan...">
                        </div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addJadwalTagihanModal">
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
                            <th>Nama Tagihan</th>
                            <th>Kategori</th>
                            <th>Nominal</th>
                            <th>Tanggal Mulai</th>
                            <th>Batas waktu</th>
                            <th>Target</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>SPP Semester Ganjil 2024/2025</td>
                            <td><span class="badge bg-primary">SPP</span></td>
                            <td>Rp 5.000.000</td>
                            <td>01 Agustus 2025</td>
                            <td>30 Agustus 2025</td>
                            <td>Semua Mahasiswa Aktif</td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i>
                                    </button>
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
                            <td>KKN Periode Juli 2025</td>
                            <td><span class="badge bg-info">KKN</span></td>
                            <td>Rp 2.500.000</td>
                            <td>15 Juli 2025</td>
                            <td>15 Agustus 2025</td>
                            <td>Mahasiswa Semester 6</td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailJadwalTagihanModal">
                                        <i class="bi bi-eye"></i>
                                    </button>
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
                            <td>Ujian Proposal</td>
                            <td><span class="badge bg-warning text-dark">Ujian</span></td>
                            <td>Rp 750.000</td>
                            <td>01 September 2025</td>
                            <td>30 September 2025</td>
                            <td>Mahasiswa Semester 7-8</td>
                            <td><span class="badge bg-secondary">Selesai</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailJadwalTagihanModal">
                                        <i class="bi bi-eye"></i>
                                    </button>
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
                            <td>Ujian Skripsi</td>
                            <td><span class="badge bg-warning text-dark">Ujian</span></td>
                            <td>Rp 1.500.000</td>
                            <td>01 September 2025</td>
                            <td>30 September 2025</td>
                            <td>Mahasiswa Semester 8</td>
                            <td><span class="badge bg-secondary">Selesai</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailJadwalTagihanModal">
                                        <i class="bi bi-eye"></i>
                                    </button>
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
                            <td>SPP Semester Genap 2024/2025</td>
                            <td><span class="badge bg-primary">SPP</span></td>
                            <td>Rp 5.000.000</td>
                            <td>01 Februari 2025</td>
                            <td>28 Februari 2025</td>
                            <td>Semua Mahasiswa Aktif</td>
                            <td><span class="badge bg-dark">Selesai</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailJadwalTagihanModal">
                                        <i class="bi bi-eye"></i>
                                    </button>
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

<!-- Add Tagihan Modal -->
<div class="modal fade" id="addJadwalTagihanModal" tabindex="-1" aria-labelledby="addJadwalTagihanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addJadwalTagihanModalLabel">Tambah Jadwal Tagihan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addJadwalTagihanForm">
                    <div class="mb-3">
                        <label for="namaTagihan" class="form-label required-field">Nama Tagihan</label>
                        <input type="text" class="form-control" id="namaTagihan" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="kategoriTagihan" class="form-label required-field">Kategori</label>
                            <select class="form-select" id="kategoriTagihan" required>
                                <option value="" selected disabled>Pilih Kategori</option>
                                <option value="spp">SPP</option>
                                <option value="kkn">KKN</option>
                                <option value="ujian">Ujian</option>
                                <option value="wisuda">Wisuda</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="nominalTagihan" class="form-label required-field">Nominal (Rp)</label>
                            <input type="number" class="form-control" id="nominalTagihan" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggalMulaiTagihan" class="form-label required-field">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggalMulaiTagihan" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggalJatuhTempo" class="form-label required-field">Tanggal Batas waktu</label>
                            <input type="date" class="form-control" id="tanggalJatuhTempo" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="targetTagihan" class="form-label required-field">Target Mahasiswa</label>
                        <select class="form-select" id="targetTagihan" required>
                            <option value="" selected disabled>Pilih Target</option>
                            <option value="semua">Semua Mahasiswa Aktif</option>
                            <option value="angkatan 2021">Angkatan 2021</option>
                            <option value="angkatan 2022">Angkatan 2022</option>
                            <option value="angkatan 2023">Angkatan 2023</option>
                            <option value="angkatan 2024">Angkatan 2024</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="saveJadwalTagihan()">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection