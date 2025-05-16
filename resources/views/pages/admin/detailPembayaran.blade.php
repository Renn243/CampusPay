@extends('layouts.admin')

@section('content')
<div id="detail-pembayaran">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Detail Pembayaran</h3>
        <button class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </button>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="bi bi-receipt text-primary fs-2"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mt-0" id="detail-pembayaran-kategori">SPP Semester Ganjil
                                    2024/2025
                                </h5>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="mb-0" id="detail-pembayaran-nama">Uzumaki Naruto</h6>
                        <small class="text-muted" id="detail-pembayaran-nim">
                            NIM:123456789
                        </small>
                    </div>

                    <table class="table table-borderless">
                        <tr>
                            <td width="40%"><strong>ID Pembayaran</strong></td>
                            <td id="detail-pembayaran-id">: PAY-20250415-001</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Pembayaran</strong></td>
                            <td id="detail-pembayaran-tanggal">: 15 April 2025</td>
                        </tr>
                        <tr>
                            <td><strong>Metode Pembayaran</strong></td>
                            <td id="detail-pembayaran-metode">: Transfer Bank (BCA)</td>
                        </tr>
                        <tr>
                            <td><strong>Status</strong></td>
                            <td id="detail-pembayaran-status">: <span class="badge bg-success">Disetujui</span></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Rincian Pembayaran</h5>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Nominal Tagihan</span>
                                <span id="detail-pembayaran-nominal">Rp 5.000.000</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Biaya Admin</span>
                                <span id="detail-pembayaran-biaya-admin">Rp 2.500</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span>Total Pembayaran</span>
                                <span class="fw-bold" id="detail-pembayaran-total">Rp 5.002.500</span>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Informasi Tagihan</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>ID Tagihan</strong></td>
                                    <td id="detail-pembayaran-id-tagihan">: INV-20230801-001</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Terbit</strong></td>
                                    <td id="detail-pembayaran-tanggal-terbit">: 01 Agustus 2023</td>
                                </tr>
                                <tr>
                                    <td><strong>Batas waktu</strong></td>
                                    <td id="detail-pembayaran-jatuh-tempo">: 30 Agustus 2023</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-outline-primary me-2">
                            <i class="bi bi-download me-2"></i> Unduh Bukti Pembayaran
                        </button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h5>Bukti Pembayaran</h5>
                    <div class="text-center">
                        <img src="https://via.placeholder.com/600x300" alt="Bukti Pembayaran" class="img-fluid border rounded">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection