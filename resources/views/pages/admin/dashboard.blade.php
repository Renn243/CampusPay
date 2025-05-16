@extends('layouts.admin')

@section('content')
<div id="dashboard">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0" id="page-title">Dashboard</h2>
        </div>
    </div>
    <div class="row dashboard-stats mb-4">
        <div class="col-md-3">
            <div class="card dashboard-card success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-muted mb-0">Total Mahasiswa</h6>
                            <h2 class="mt-2 mb-0">1,250</h2>
                        </div>
                        <div class="dashboard-icon text-success">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card dashboard-card primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-muted mb-0">Total Pembayaran</h6>
                            <h2 class="mt-2 mb-0">Rp 1.2M</h2>
                        </div>
                        <div class="dashboard-icon text-primary">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card dashboard-card warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-muted mb-0">Tagihan Pending</h6>
                            <h2 class="mt-2 mb-0">245</h2>
                        </div>
                        <div class="dashboard-icon text-warning">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-3">
            <div class="card dashboard-card danger">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-muted mb-0">Tagihan Terlambat</h6>
                            <h2 class="mt-2 mb-0">68</h2>
                        </div>
                        <div class="dashboard-icon text-danger">
                            <i class="bi bi-exclamation-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Pembayaran Terbaru</span>
                    <a href="#pembayaran" href="/admin/pembayaran" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Mahasiswa</th>
                                    <th>Kategori</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>PAY-20250815-001</td>
                                    <td>Budi Santoso</td>
                                    <td>SPP Semester Ganjil</td>
                                    <td>Rp 5.000.000</td>
                                    <td>15 Agustus 2025</td>
                                    <td><span class="badge bg-success">Disetujui</span></td>
                                </tr>
                                <tr>
                                    <td>PAY-20250815-002</td>
                                    <td>Siti Nuraini</td>
                                    <td>KKN</td>
                                    <td>Rp 2.500.000</td>
                                    <td>15 Agustus 2025</td>
                                    <td><span class="badge bg-success">Disetujui</span></td>
                                </tr>
                                <tr>
                                    <td>PAY-20250814-003</td>
                                    <td>Ahmad Rizki</td>
                                    <td>Ujian Proposal</td>
                                    <td>Rp 750.000</td>
                                    <td>14 Agustus 2025</td>
                                    <td><span class="badge bg-warning text-dark">Menunggu</span></td>
                                </tr>
                                <tr>
                                    <td>PAY-20250814-004</td>
                                    <td>Dewi Lestari</td>
                                    <td>SPP Semester Ganjil</td>
                                    <td>Rp 5.000.000</td>
                                    <td>14 Agustus 2025</td>
                                    <td><span class="badge bg-success">Disetujui</span></td>
                                </tr>
                                <tr>
                                    <td>PAY-20250813-005</td>
                                    <td>Rudi Hartono</td>
                                    <td>Ujian Skripsi</td>
                                    <td>Rp 1.500.000</td>
                                    <td>13 Agustus 2025</td>
                                    <td><span class="badge bg-danger">Ditolak</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Pengumuman Terbaru</span>
                    <a href="/admin/pengumuman" class="btn btn-sm btn-outline-primary">Kelola</a>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Pembayaran SPP Semester Ganjil 2024/2025</h6>
                            </div>
                            <p class="mb-1 text-truncate">Pembayaran SPP untuk semester ganjil tahun ajaran 2024/2025 telah dibuka.</p>
                            <small class="text-muted">1 Agustus - 30 Agustus 2025</small>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Pembayaran KKN Periode Juli 2025</h6>
                            </div>
                            <p class="mb-1 text-truncate">Bagi mahasiswa yang akan mengikuti KKN periode Juli 2025, pembayaran biaya KKN telah dibuka.</p>
                            <small class="text-muted">15 Juli - 15 Agustus 2025</small>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Pembayaran Ujian Skripsi</h6>
                            </div>
                            <p class="mb-1 text-truncate">Pembayaran ujian skripsi untuk periode wisuda Oktober 2025 telah dibuka.</p>
                            <small class="text-muted">1 September - 30 September 2025</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection