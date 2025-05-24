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
                                    @if ($tagihan_mahasiswa->status === 'lunas')
                                    <span class="badge bg-success">Lunas</span>
                                    @elseif ($tagihan_mahasiswa->status === 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                    @else
                                    <span class="badge bg-danger">Belum Bayar</span>
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
                            @if(!empty($transaksi->alasan))
                            <tr>
                                <td><strong>Alasan</strong></td>
                                <td>: {{ $transaksi->alasan }}</td>
                            </tr>
                            @endif
                        </table>

                        <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#uploadModal">
                            Upload Bukti Pembayaran
                        </button>
                        @if($transaksi->foto_bukti_transaksi)
                        <a href="{{ asset($transaksi->foto_bukti_transaksi) }}"
                            download
                            class="btn btn-success mt-4">
                            Download Bukti Pembayaran
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Upload Payment -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('uploadBukti', [$transaksi->id_transaksi, $tagihan_mahasiswa->id]) }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Bukti Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="image" class="form-label">Pilih Gambar Bukti Pembayaran</label>
                    <input class="form-control" type="file" id="image" name="image" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Upload</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </form>
    </div>
</div>
@endsection