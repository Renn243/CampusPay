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
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <!-- <div class="mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-receipt text-primary fs-2"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mt-0"></h5>
                                </div>
                            </div>
                        </div> -->

                        <table class="table table-borderless">
                            <tr>
                                <td width="40%"><strong>ID Pembayaran</strong></td>
                                <td>: {{ $transaksi->order_id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Pembayaran</strong></td>
                                <td>: {{ \Carbon\Carbon::parse($transaksi->tanggal_bayar)->translatedFormat('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Metode Pembayaran</strong></td>
                                <td>: {{ $transaksi->metode_transaksi }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>:
                                    @if ($transaksi->status === 'sukses')
                                    <span class="badge bg-success">Sukses</span>
                                    @elseif ($transaksi->status === 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                    @else
                                    <span class="badge bg-danger">Gagal</span>
                                    @endif
                                </td>
                            </tr>
                        </table>

                    </div>

                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Nominal Pembayaran</span>
                                    <span>Rp {{ number_format($transaksi->jumlah_bayar, 0, ',', '.') }}</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Total Dibayar</span>
                                    <span class="fw-bold">Rp {{ number_format($transaksi->jumlah_bayar, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="text-center mt-3">
                            <a href="{{ asset('storage/' . $transaksi->foto_bukti_transaksi) }}" class="btn btn-outline-primary" download>
                                <i class="bi bi-download me-2"></i> Unduh Bukti Pembayaran
                            </a>
                        </div> -->
                    </div>
                </div>

                <!-- <div class="row">
                    <div class="col-md-12">
                        <h5>Bukti Pembayaran</h5>
                        <div class="text-center">
                            <img src="{{ asset('storage/' . $transaksi->foto_bukti_transaksi) }}" alt="Bukti Pembayaran" class="img-fluid border rounded">
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
@endsection