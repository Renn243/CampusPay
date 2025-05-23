@extends('layouts.admin')

@section('content')
<div id="pembayaran">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0" id="page-title">Pembayaran</h2>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0">Daftar Pembayaran</h5>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-md-end">
                        <form method="GET" action="{{ route('admin.listPembayaran') }}" class="d-flex">
                            <div class="search-box me-2 position-relative">
                                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-2 text-muted"></i>
                                <input
                                    type="text"
                                    name="search"
                                    class="form-control ps-5"
                                    placeholder="Cari pembayaran..."
                                    value="{{ request('search') }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Mahasiswa</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tagihan as $item)
                        <tr>
                            <td>{{ $item->id_transaksi }}</td>
                            <td>
                                <h6 class="mb-0">{{ $item->mahasiswa->nama_mahasiswa }}</h6>
                                <small class="text-muted">{{ $item->mahasiswa->nim }}</small>
                            </td>
                            <td>{{ $item->tagihan->nama_tagihan ?? '-' }}</td>
                            <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->translatedFormat('d F Y') }}</td>
                            <td>{{ $item->metode_pembayaran ?? '-' }}</td>
                            <td>
                                @php
                                $statusBadge = match(strtolower($item->status)) {
                                'sukses' => 'success',
                                'pending' => 'warning',
                                'gagal' => 'danger',
                                default => 'secondary',
                                };
                                @endphp

                                <span class="badge bg-{{ $statusBadge }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons d-flex gap-1 align-items-center">
                                    <a href="{{ route('admin.detailPembayaran', $item->id_transaksi) }}" class="btn btn-sm btn-primary" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    @if($item->status === 'pending')
                                    <form action="{{ route('admin.updateStatusPembayaran', $item->id_transaksi) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="sukses">
                                        <button type="submit" class="btn btn-sm btn-success" title="Approve">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.updateStatusPembayaran', $item->id_transaksi) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit" class="btn btn-sm btn-danger" title="Tolak">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Data pembayaran tidak tersedia</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $tagihan->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
</div>
@endsection