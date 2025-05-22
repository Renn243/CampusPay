@extends('layouts.admin')

@section('content')
<div id="pengumuman">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0" id="page-title">Pengumuman</h2>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0">Kelola Pengumuman</h5>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-md-end">
                        <div class="search-box me-2">
                            <i class="bi bi-search"></i>
                            <input type="text" class="form-control" placeholder="Cari pengumuman...">
                        </div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPengumumanModal">
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
                            <th>Judul</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Pembayaran SPP Semester Ganjil 2024/2025</td>
                            <td>01 Agustus 2025</td>
                            <td>30 Agustus 2025</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/admin/detailPengumuman" class="text-decoration-none">
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
                            <td>Pembayaran KKN Periode Juli 2025</td>
                            <td>15 Juli 2025</td>
                            <td>15 Agustus 2025</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/admin/detailPengumuman" class="text-decoration-none">
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
                            <td>Pembayaran Ujian Skripsi</td>
                            <td>01 September 2025</td>
                            <td>30 September 2025</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/admin/detailPengumuman" class="text-decoration-none">
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
                            <td>Pembayaran Ujian Proposal</td>
                            <td>10 Juli 2025</td>
                            <td>10 Agustus 2025</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/admin/detailPengumuman" class="text-decoration-none">
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
                            <td>Pembayaran Wisuda Periode Oktober 2025</td>
                            <td>01 Agustus 2025</td>
                            <td>15 September 2025</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/admin/detailPengumuman" class="text-decoration-none">
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

<!-- Add Pengumuman Modal -->
<div class="modal fade" id="addPengumumanModal" tabindex="-1" aria-labelledby="addPengumumanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPengumumanModalLabel">Tambah Pengumuman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPengumumanForm">
                    <div class="mb-3">
                        <label for="judulPengumuman" class="form-label required-field">Judul Pengumuman</label>
                        <input type="text" class="form-control" id="judulPengumuman" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggalMulai" class="form-label required-field">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggalMulai" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggalSelesai" class="form-label required-field">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="tanggalSelesai" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="isiPengumuman" class="form-label required-field">Isi Pengumuman</label>
                        <textarea class="form-control" id="isiPengumuman" rows="5" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection