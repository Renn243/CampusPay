@extends('layouts.admin')

@section('content')
<div id="detail-pembayaran" class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Detail Pembayaran</h3>
        <a href="{{ route('admin.listPembayaran') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-4">
                <!-- Informasi Mahasiswa dan Transaksi -->
                <div class="col-md-6">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-receipt text-primary fs-2"></i>
                        <h5 class="ms-3 mb-0">{{ $transaksiById->tagihan->nama_tagihan ?? '-' }}</h5>
                    </div>

                    <h6 class="mb-1">{{ $transaksiById->mahasiswa->nama_mahasiswa ?? '-' }}</h6>
                    <small class="text-muted">NIM: {{ $transaksiById->mahasiswa->nim ?? '-' }}</small>

                    <table class="table table-borderless mt-3">
                        <tbody>
                            <tr>
                                <td class="fw-semibold" style="width: 40%;">ID Pembayaran</td>
                                <td>: {{ $transaksiById->id_transaksi }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Order ID</td>
                                <td>: {{ $transaksiById->order_id ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Tanggal Pembayaran</td>
                                <td>: {{ \Carbon\Carbon::parse($transaksiById->tanggal_bayar)->translatedFormat('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Metode Pembayaran</td>
                                <td>: {{ $transaksiById->metode_transaksi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Status</td>
                                <td>
                                    :
                                    <span class="badge 
                                        {{ $transaksiById->status === 'sukses' ? 'bg-success' : 
                                           ($transaksiById->status === 'pending' ? 'bg-warning text-dark' : 'bg-danger') }}">
                                        {{ ucfirst($transaksiById->status) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Jumlah Bayar</td>
                                <td>: Rp {{ number_format($transaksiById->jumlah_bayar ?? 0, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Informasi Tagihan -->
                <div class="col-md-6">
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Informasi Tagihan</h5>
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td class="fw-semibold" style="width: 40%;">Nama Tagihan</td>
                                        <td>: {{ $transaksiById->tagihan->nama_tagihan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold">Kategori</td>
                                        <td>: {{ $transaksiById->tagihan->kategori ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold">Nominal</td>
                                        <td>: Rp {{ number_format($transaksiById->tagihan->nominal ?? 0, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold">Tanggal Mulai</td>
                                        <td>:
                                            {{ $transaksiById->tagihan->tanggal_mulai
                                                ? \Carbon\Carbon::parse($transaksiById->tagihan->tanggal_mulai)->translatedFormat('d F Y')
                                                : '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold">Tanggal Batas</td>
                                        <td>:
                                            {{ $transaksiById->tagihan->tanggal_batas
                                                ? \Carbon\Carbon::parse($transaksiById->tagihan->tanggal_batas)->translatedFormat('d F Y')
                                                : '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold">Angkatan</td>
                                        <td>: {{ $transaksiById->tagihan->angkatan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold">ID Mahasiswa</td>
                                        <td>: {{ $transaksiById->id_mahasiswa }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold">ID Tagihan</td>
                                        <td>: {{ $transaksiById->id_tagihan }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Optional: Ringkasan Pembayaran -->
                    <div class="card">
                        <div class="card-body d-flex justify-content-between">
                            <span class="fw-semibold">Total Dibayar</span>
                            <span class="fw-bold text-primary">
                                Rp {{ number_format($transaksiById->jumlah_bayar ?? 0, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection