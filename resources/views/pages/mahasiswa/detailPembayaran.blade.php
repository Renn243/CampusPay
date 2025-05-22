@extends('layouts.mahasiswa')

@section('content')
<div class="col-md-9 col-lg-10 ms-sm-auto content p-4">
    <div id="detailPembayaran" class="page">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Detail Pembayaran</h2>
            <button class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </button>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Informasi Pembayaran</h5>
                    <span class="badge bg-success">Disetujui</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-receipt text-primary fs-2"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mt-0">SPP Semester Ganjil 2023/2024</h5>
                                    <p class="text-muted mb-0">Pembayaran telah diverifikasi dan disetujui</p>
                                </div>
                            </div>
                        </div>

                        <table class="table table-borderless">
                            <tr>
                                <td width="40%"><strong>ID Pembayaran</strong></td>
                                <td>: PAY-20230815-001</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Pembayaran</strong></td>
                                <td>: 15 Agustus 2023</td>
                            </tr>
                            <tr>
                                <td><strong>Metode Pembayaran</strong></td>
                                <td>: Transfer Bank (BCA)</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>: <span class="badge bg-success">Disetujui</span></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Persetujuan</strong></td>
                                <td>: 16 Agustus 2023</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5 class="card-title">Rincian Pembayaran</h5>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Nominal Tagihan</span>
                                    <span>Rp 5.000.000</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Biaya Admin</span>
                                    <span>Rp 2.500</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Total Pembayaran</span>
                                    <span class="fw-bold">Rp 5.002.500</span>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <button class="btn btn-outline-primary">
                                <i class="bi bi-download me-2"></i> Unduh Bukti Pembayaran
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h5>Bukti Pembayaran</h5>
                        <div class="text-center">
                            <img src="https://via.placeholder.com/600x300" alt="Bukti Pembayaran"
                                class="img-fluid border rounded">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection