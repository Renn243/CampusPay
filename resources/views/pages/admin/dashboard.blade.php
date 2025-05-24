@extends('layouts.admin')

@section('content')
<div id="dashboard">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0" id="page-title">Dashboard</h2>
        </div>
    </div>

    {{-- Statistik Cards --}}
    <div class="row dashboard-stats mb-4">
        <div class="col-md-3">
            <div class="card dashboard-card success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-muted mb-0">Total Mahasiswa</h6>
                            <h2 class="mt-2 mb-0">{{ number_format($totalMahasiswa) }}</h2>
                        </div>
                        <div class="dashboard-icon text-success">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card dashboard-card primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-muted mb-0">Total Pembayaran</h6>
                            <h2 class="mt-2 mb-0">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</h2>
                        </div>
                        <div class="dashboard-icon text-primary">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card dashboard-card warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-muted mb-0">Tagihan Pending</h6>
                            <h2 class="mt-2 mb-0">{{ number_format($totalTagihanPending) }}</h2>
                        </div>
                        <div class="dashboard-icon text-warning">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card dashboard-card danger">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-muted mb-0">Tagihan Ditolak</h6>
                            <h2 class="mt-2 mb-0">{{ number_format($totalTagihanDitolak) }}</h2>
                        </div>
                        <div class="dashboard-icon text-danger">
                            <i class="bi bi-x-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Transaksi Terbaru --}}
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Transaksi Terbaru</span>
                    <a href="{{ route('admin.listPembayaran') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Mahasiswa</th>
                                    <th>Kategori</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksiTerbaru as $transaksi)
                                <tr>
                                    <td>{{ $transaksi->id }}</td>
                                    <td>{{ $transaksi->mahasiswa->nama_mahasiswa ?? '-' }}</td>
                                    <td>{{ $transaksi->tagihan->nama_tagihan }}</td>
                                    <td>Rp {{ number_format($transaksi->tagihan->nominal, 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaksi->tanggal)->translatedFormat('d F Y') }}</td>
                                    <td>
                                        @if($transaksi->status == 'lunas')
                                        <span class="badge bg-success">Lunas</span>
                                        @elseif($transaksi->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                        @elseif($transaksi->status == 'ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                        @elseif($transaksi->status == 'belum bayar')
                                        <span class="badge bg-danger">Belum Bayar</span>
                                        @else
                                        <span class="badge bg-secondary">{{ ucfirst($transaksi->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada transaksi terbaru</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pengumuman Terbaru --}}
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Pengumuman Terbaru</span>
                    <a href="{{ route('admin.listPengumuman') }}" class="btn btn-sm btn-outline-primary">Kelola</a>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @forelse ($pengumumanTerbaru as $pengumuman)
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ $pengumuman->judul }}</h6>
                            </div>
                            <p class="mb-1 text-truncate">{{ $pengumuman->deskripsi }}</p>
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($pengumuman->tanggal_mulai)->translatedFormat('d F Y') }}
                                @if($pengumuman->tanggal_selesai)
                                - {{ \Carbon\Carbon::parse($pengumuman->tanggal_selesai)->translatedFormat('d F Y') }}
                                @endif
                            </small>
                        </a>
                        @empty
                        <p class="text-center">Tidak ada pengumuman terbaru</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection