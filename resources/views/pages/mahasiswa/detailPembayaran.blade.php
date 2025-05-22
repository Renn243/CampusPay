@extends('layouts.mahasiswa')

@section('content')
<div class="col-md-9 col-lg-10 ms-sm-auto content p-4">
    <div id="detailPembayaran" class="page">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Detail Pembayaran</h2>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Informasi Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless mb-0">
                            <tr>
                                <td width="45%"><strong>ID Pembayaran</strong></td>
                                <td>: {{ $transaksi->id_transaksi }}</td>
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
                                    <span class="badge bg-warning text-dark">Pending</span>
                                    @else
                                    <span class="badge bg-danger">Gagal</span>
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <div class="mt-3 p-3 bg-light rounded">
                            <div class="d-flex justify-content-between">
                                <span><strong>Nominal Pembayaran</strong></span>
                                <span class="text-primary fw-bold">Rp {{ number_format($transaksi->jumlah_bayar, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Informasi Tagihan</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless mb-0">
                            <tr>
                                <td width="45%"><strong>Nama Tagihan</strong></td>
                                <td>: {{ $transaksi->tagihan->nama_tagihan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Kategori</strong></td>
                                <td>: {{ $transaksi->tagihan->kategori ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Mulai</strong></td>
                                <td>:
                                    {{ $transaksi->tagihan->tanggal_mulai
                                        ? \Carbon\Carbon::parse($transaksi->tagihan->tanggal_mulai)->translatedFormat('d F Y')
                                        : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Batas</strong></td>
                                <td>:
                                    {{ $transaksi->tagihan->tanggal_batas
                                        ? \Carbon\Carbon::parse($transaksi->tagihan->tanggal_batas)->translatedFormat('d F Y')
                                        : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Angkatan</strong></td>
                                <td>: {{ $transaksi->tagihan->angkatan ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection