@extends('layouts.mahasiswa')

@section('content')
<div class="col-md-9 col-lg-10 ms-sm-auto content p-4">
    <div id="pembayaran" class="page">
        <h2 class="mb-4">Pembayaran</h2>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Pilih Tagihan</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">SPP Semester Ganjil 2023/2024</h6>
                                        <p class="mb-1 text-muted small">Batas waktu: 30 Agustus 2023</p>
                                    </div>
                                    <div class="text-end">
                                        <h5 class="mb-1">Rp 5.000.000</h5>
                                        <span class="badge bg-danger">Belum Dibayar</span>
                                    </div>
                                </div>
                                <div class="mt-2 d-grid">
                                    <button class="btn btn-primary btn-bayar" data-category="SPP Semester Ganjil 2023/2024" data-amount="5000000">
                                        Bayar Sekarang
                                    </button>
                                </div>
                            </div>

                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">KKN Periode Juli 2023</h6>
                                        <p class="mb-1 text-muted small">Batas waktu: 15 Agustus 2023</p>
                                    </div>
                                    <div class="text-end">
                                        <h5 class="mb-1">Rp 2.500.000</h5>
                                        <span class="badge bg-danger">Belum Dibayar</span>
                                    </div>
                                </div>
                                <div class="mt-2 d-grid">
                                    <button class="btn btn-primary btn-bayar" data-category="KKN Periode Juli 2023" data-amount="2500000">
                                        Bayar Sekarang
                                    </button>
                                </div>
                            </div>

                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Ujian Proposal</h6>
                                        <p class="mb-1 text-muted small">Batas waktu: 30 September 2023</p>
                                    </div>
                                    <div class="text-end">
                                        <h5 class="mb-1">Rp 750.000</h5>
                                        <span class="badge bg-danger">Belum Dibayar</span>
                                    </div>
                                </div>
                                <div class="mt-2 d-grid">
                                    <button class="btn btn-primary btn-bayar" data-category="Ujian Proposal" data-amount="750000">
                                        Bayar Sekarang
                                    </button>
                                </div>
                            </div>

                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Ujian Skripsi</h6>
                                        <p class="mb-1 text-muted small">Batas waktu: 15 Oktober 2023</p>
                                    </div>
                                    <div class="text-end">
                                        <h5 class="mb-1">Rp 1.500.000</h5>
                                        <span class="badge bg-danger">Belum Dibayar</span>
                                    </div>
                                </div>
                                <div class="mt-2 d-grid">
                                    <button class="btn btn-primary btn-bayar" data-category="Ujian Skripsi" data-amount="1500000">
                                        Bayar Sekarang
                                    </button>
                                </div>
                            </div>

                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Biaya Wisuda</h6>
                                        <p class="mb-1 text-muted small">Batas waktu: 30 November 2023</p>
                                    </div>
                                    <div class="text-end">
                                        <h5 class="mb-1">Rp 3.000.000</h5>
                                        <span class="badge bg-danger">Belum Dibayar</span>
                                    </div>
                                </div>
                                <div class="mt-2 d-grid">
                                    <button class="btn btn-primary btn-bayar" data-category="Biaya Wisuda" data-amount="3000000">
                                        Bayar Sekarang
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">Informasi Pembayaran</div>
                    <div class="card-body">
                        <h5>Petunjuk Pembayaran</h5>
                        <ol class="ps-3">
                            <li>Pilih tagihan yang ingin Anda bayar</li>
                            <li>Klik tombol "Bayar Sekarang"</li>
                            <li>Pilih metode pembayaran yang tersedia</li>
                            <li>Lakukan pembayaran sesuai instruksi</li>
                            <li>Pembayaran akan diverifikasi secara otomatis</li>
                        </ol>
                        <div class="alert alert-info" role="alert">
                            <i class="bi bi-info-circle me-2"></i> Pembayaran akan langsung terverifikasi setelah pembayaran berhasil.
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Kontak Bantuan</div>
                    <div class="card-body">
                        <p><i class="bi bi-telephone me-2"></i> (021) 1234-5678</p>
                        <p><i class="bi bi-envelope me-2"></i> keuangan@kampus.ac.id</p>
                        <p><i class="bi bi-clock me-2"></i> Senin-Jumat, 08.00-16.00 WIB</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="paymentModalLabel">Konfirmasi Pembayaran</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="bi bi-credit-card-2-front text-primary" style="font-size: 3rem;"></i>
                        <h4 class="mt-2" id="paymentCategory">-</h4>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Nominal Tagihan</span>
                                <span class="fw-bold" id="paymentAmount">-</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Biaya Admin</span>
                                <span>Rp 2.500</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Total Pembayaran</span>
                                <span class="fw-bold text-primary" id="paymentTotal">-</span>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Dengan melanjutkan, Anda akan diarahkan ke halaman pembayaran Midtrans untuk menyelesaikan transaksi.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="proceedToPayment()">
                        <i class="bi bi-arrow-right-circle me-2"></i> Lanjutkan Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection