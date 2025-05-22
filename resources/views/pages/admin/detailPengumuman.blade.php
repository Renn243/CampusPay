@extends('layouts.admin')

@section('content')
<div id="detail-pengumuman">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Detail Pengumuman</h3>
        <button class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </button>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-4">
                <h4 id="detail-pengumuman-judul">Pembayaran SPP Semester Ganjil 2024/2025</h4>
                <div class="d-flex align-items-center text-muted mb-3">
                    <i class="bi bi-calendar me-2"></i>
                    <span id="detail-pengumuman-periode">01 April 2025 - 30 April 2025</span>
                </div>
            </div>

            <div class="mb-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <p id="detail-pengumuman-isi">
                            Pembayaran SPP untuk semester ganjil tahun ajaran 2024/2025 telah dibuka.
                            Bagi seluruh mahasiswa aktif diharapkan untuk segera melakukan pembayaran
                            SPP sebelum tanggal 30 April 2025.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection