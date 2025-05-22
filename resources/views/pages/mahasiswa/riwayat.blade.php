@extends('layouts.mahasiswa')

@section('content')
<div class="col-md-9 col-lg-10 ms-sm-auto content p-4">
    <div id="riwayat" class="page">
        <h2 class="mb-4">Riwayat Pembayaran</h2>

        <div class="card mb-4">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="mb-0">Daftar Pembayaran</h5>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Cari pembayaran...">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID Pembayaran</th>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transaksi as $item)
                            <tr>
                                <td>{{ $item->kode_pembayaran ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</td>
                                <td>{{ $item->tagihan->nama_tagihan ?? 'N/A' }}</td>
                                <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                <td>
                                    @if ($item->status === 'disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                    @elseif ($item->status === 'menunggu')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                    @else
                                    <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('detailPembayaran', ['id' => $item->id]) }}">
                                        <button class="btn btn-sm btn-primary">Detail</button>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data pembayaran.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $transaksi->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection