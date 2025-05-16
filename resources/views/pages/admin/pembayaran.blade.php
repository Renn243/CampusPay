@extends('layouts.admin')

@section('content')
<div id="pembayaran">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0" id="page-title">Pembayaran</h2>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0">Daftar Pembayaran</h5>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-md-end">
                        <div class="search-box me-2">
                            <i class="bi bi-search"></i>
                            <input type="text" class="form-control" placeholder="Cari pembayaran...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID Pembayaran</th>
                            <th>Mahasiswa</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>PAY-20230815-001</td>
                            <td>
                                <h6 class="mb-0">Uzumaki Naruto</h6>
                                <small class="text-muted">123456789</small>
                            </td>
                            <td>SPP Semester Ganjil</td>
                            <td>Rp 5.000.000</td>
                            <td>15 april 2025</td>
                            <td>Transfer Bank</td>
                            <td><span class="badge bg-success">Disetujui</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/admin/detailPembayaran" class="text-decoration-none">
                                        <button class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>PAY-20250415-002</td>
                            <td>
                                <h6 class="mb-0">Uchiha Sassuke</h6>
                                <small class="text-muted">123456790</small>
                            </td>
                            <td>KKN</td>
                            <td>Rp 2.500.000</td>
                            <td>15 April 2025</td>
                            <td>Transfer Bank</td>
                            <td><span class="badge bg-success">Disetujui</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/admin/detailPembayaran" class="text-decoration-none">
                                        <button class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>PAY-20250414-003</td>
                            <td>

                                <h6 class="mb-0">Hatake Kakashi</h6>
                                <small class="text-muted">123456791</small>
                            </td>
                            <td>Ujian Proposal</td>
                            <td>Rp 750.000</td>
                            <td>14 April 2025</td>
                            <td>Transfer Bank</td>
                            <td><span class="badge bg-warning text-dark">Menunggu</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/admin/detailPembayaran" class="text-decoration-none">
                                        <button class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-sm btn-success">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>PAY-20250414-004</td>
                            <td>
                                <h6 class="mb-0">Gaara</h6>
                                <small class="text-muted">123456792</small>
                            </td>
                            <td>SPP Semester Ganjil</td>
                            <td>Rp 5.000.000</td>
                            <td>14 April 2025</td>
                            <td>Transfer Bank</td>
                            <td><span class="badge bg-success">Disetujui</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/admin/detailPembayaran" class="text-decoration-none">
                                        <button class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>PAY-20250413-005</td>
                            <td>
                                <h6 class="mb-0">Uchiha Itachi</h6>
                                <small class="text-muted">123456793</small>
                            </td>
                            <td>Ujian Skripsi</td>
                            <td>Rp 1.500.000</td>
                            <td>13 April 2025</td>
                            <td>Transfer Bank</td>
                            <td><span class="badge bg-danger">Ditolak</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/admin/detailPembayaran" class="text-decoration-none">
                                        <button class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </a>
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
@endsection