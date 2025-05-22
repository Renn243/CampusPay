@extends('layouts.admin')

@section('content')
<div id="detail-pengumuman">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Detail Pengumuman</h3>
        <a href="{{ route('admin.listPengumuman') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-4">
                <h4 id="detail-pengumuman-judul">{{ $pengumumanById->judul }}</h4>
                <div class="d-flex align-items-center text-muted mb-3">
                    <i class="bi bi-calendar me-2"></i>
                    <span id="detail-pengumuman-periode">
                        {{ \Carbon\Carbon::parse($pengumumanById->tanggal_mulai)->format('d M Y') }} -
                        {{ \Carbon\Carbon::parse($pengumumanById->tanggal_batas)->format('d M Y') }}
                    </span>
                </div>
            </div>

            <div class="mb-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <p id="detail-pengumuman-isi">{{ $pengumumanById->deskripsi }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection