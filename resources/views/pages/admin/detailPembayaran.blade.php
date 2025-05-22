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
                <div class="col-md-6">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-receipt text-primary fs-2"></i>
                        <h5 class="ms-3 mb-0" id="detail-pembayaran-kategori">
                            {{ $transaksiById->tagihan->nama_tagihan ?? '-' }}
                        </h5>
                    </div>

                    <h6 class="mb-1" id="detail-pembayaran-nama">{{ $transaksiById->mahasiswa->nama_mahasiswa ?? '-' }}</h6>
                    <small class="text-muted" id="detail-pembayaran-nim">
                        NIM: {{ $transaksiById->mahasiswa->nim ?? '-' }}
                    </small>

                    <table class="table table-borderless mt-3">
                        <tbody>
                            <tr>
                                <td class="fw-semibold" style="width: 40%;">ID Pembayaran</td>
                                <td id="detail-pembayaran-id">: {{ $transaksiById->id_transaksi }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Tanggal Pembayaran</td>
                                <td id="detail-pembayaran-tanggal">: {{ \Carbon\Carbon::parse($transaksiById->tanggal_dibayar)->translatedFormat('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Metode Pembayaran</td>
                                <td id="detail-pembayaran-metode">: {{ $transaksiById->metode_pembayaran ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Status</td>
                                <td id="detail-pembayaran-status">
                                    :
                                    <span class="badge 
                                        {{ $transaksiById->status == 'sukses' ? 'bg-success' : 
                                           ($transaksiById->status == 'pending' ? 'bg-warning text-dark' : 'bg-danger') }}">
                                        {{ ucfirst($transaksiById->status) }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Rincian Pembayaran</h5>
                            <div class="d-flex justify-content-between">
                                <span>Nominal Tagihan</span>
                                <span id="detail-pembayaran-total" class="fw-bold">
                                    Rp {{ number_format($transaksiById->jumlah_pembayaran ?? 0, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Informasi Tagihan</h5>
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td class="fw-semibold">Kategori</td>
                                        <td>: {{ $transaksiById->tagihan->kategori ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold">Tanggal Terbit</td>
                                        <td>: {{ \Carbon\Carbon::parse($transaksiById->tagihan->tanggal_terbit ?? now())->translatedFormat('d F Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection