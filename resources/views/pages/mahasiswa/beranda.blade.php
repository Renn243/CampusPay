@extends('layouts.mahasiswa')

@section('content')
<div class="col-md-9 col-lg-10 ms-sm-auto content p-4">
    <div id="beranda" class="page active">
        <h2 class="mb-4">Beranda</h2>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Pengumuman</span>
                        <span class="badge bg-primary">Terbaru</span>
                    </div>
                    <div class="card-body">
                        <div class="announcement-card p-3 mb-3">
                            <h5>Pembayaran SPP Semester Ganjil 2023/2024</h5>
                            <p class="text-muted mb-2"><i class="bi bi-calendar"></i> 1 Agustus 2023 - 30 Agustus 2023</p>
                            <p>
                                Pembayaran SPP untuk semester ganjil tahun ajaran 2023/2024 telah dibuka.
                                Harap segera melakukan pembayaran sebelum batas waktu yang ditentukan.
                            </p>
                        </div>

                        <div class="announcement-card p-3 mb-3">
                            <h5>Pembayaran KKN Periode Juli 2023</h5>
                            <p class="text-muted mb-2"><i class="bi bi-calendar"></i> 15 Juli 2023 - 15 Agustus 2023
                            </p>
                            <p>
                                Bagi mahasiswa yang akan mengikuti KKN periode Juli 2023, pembayaran biaya
                                KKN telah dibuka. Silakan melakukan pembayaran melalui sistem Campus Pay.
                            </p>
                        </div>

                        <div class="announcement-card p-3">
                            <h5>Pembayaran Ujian Skripsi</h5>
                            <p class="text-muted mb-2"><i class="bi bi-calendar"></i> 1 September 2023 - 30 September 2023</p>
                            <p>
                                Pembayaran ujian skripsi untuk periode wisuda Oktober 2023 telah dibuka.
                                Pastikan semua persyaratan telah dipenuhi sebelum melakukan pembayaran.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-bell-fill me-2"></i> Tagihan Aktif</span>
                            <span class="badge bg-warning text-dark">Penting</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0">SPP Semester Ganjil</h5>
                            <span class="badge bg-danger">Belum Dibayar</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Nominal:</span>
                            <span class="fw-bold">Rp 5.000.000</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Batas waktu:</span>
                            <span class="text-danger fw-bold">30 Agustus 2023</span>
                        </div>

                        <a href="{{ url('pembayaran') }}" class="btn btn-primary w-100 mb-2">
                            <i class="bi bi-credit-card me-2"></i> Bayar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection