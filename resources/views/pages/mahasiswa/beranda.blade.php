@extends('layouts.mahasiswa')

@section('content')
<div class="col-md-9 col-lg-10 ms-sm-auto content p-4">
    <div id="beranda" class="page active">
        <h2 class="mb-4">Beranda</h2>

        <div class="row">
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Pengumuman</span>
                            <span class="badge bg-primary">Terbaru</span>
                        </div>
                        <div class="card-body">
                            @if ($pengumuman)
                            <div class="announcement-card p-3 mb-3">
                                <h5>{{ $pengumuman->judul }}</h5>
                                <p class="text-muted mb-2"><i class="bi bi-calendar"></i>
                                    {{ \Carbon\Carbon::parse($pengumuman->tanggal_mulai)->format('d M Y') }} -
                                    {{ \Carbon\Carbon::parse($pengumuman->tanggal_selesai)->format('d M Y') }}
                                </p>
                                <p>{{ $pengumuman->deskripsi }}</p>
                            </div>
                            @else
                            <p class="text-muted">Tidak ada pengumuman saat ini.</p>
                            @endif
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
                            @if ($tagihan && $tagihan->tagihan)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="mb-0">{{ $tagihan->tagihan->nama ?? 'Tagihan' }}</h5>
                                <span class="badge bg-danger">Belum Dibayar</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted">Nominal:</span>
                                <span class="fw-bold">Rp {{ number_format($tagihan->tagihan->nominal ?? 0, 0, ',', '.') }}</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Batas waktu:</span>
                                <span class="text-danger fw-bold">
                                    {{ \Carbon\Carbon::parse($tagihan->tagihan->batas_waktu)->format('d M Y') }}
                                </span>
                            </div>

                            <a href="{{ url('pembayaran') }}" class="btn btn-primary w-100 mb-2">
                                <i class="bi bi-credit-card me-2"></i> Bayar Sekarang
                            </a>
                            @else
                            <p class="text-muted">Tidak ada tagihan yang perlu dibayar saat ini.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection