@extends('layouts.mahasiswa')

@section('content')
<div class="col-md-9 col-lg-10 ms-sm-auto content p-4">
    <div id="pembayaran" class="page">
        <h2 class="mb-4">Pembayaran</h2>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Pilih Tagihan</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @forelse ($transaksi as $item)
                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">{{ $item->tagihan->nama_tagihan ?? 'Tagihan' }}</h6>
                                        <p class="mb-1 text-muted small">Batas waktu: {{ \Carbon\Carbon::parse($item->tagihan->tanggal_batas)->format('d F Y') }}</p>
                                    </div>
                                    <div class="text-end">
                                        <h5 class="mb-1">Rp {{ number_format($item->tagihan->nominal, 0, ',', '.') }}</h5>
                                        @if($item->status == 'lunas')
                                        <span class="badge bg-success">Lunas</span>
                                        @elseif($item->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                        @elseif($item->status == 'belum bayar')
                                        <span class="badge bg-danger">Belum bayar</span>
                                        @else
                                        <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </div>
                                </div>
                                @if($item->status == 'belum bayar' || $item->status == 'ditolak')
                                <div class="mt-2 d-grid">
                                    <button
                                        type="button"
                                        class="btn btn-primary btn-bayar"
                                        data-bs-toggle="modal"
                                        data-bs-target="#paymentModal"
                                        data-id="{{ $item->id_tagihan }}"
                                        data-category="{{ $item->tagihan->nama_tagihan }}"
                                        data-amount="{{ $item->tagihan->nominal }}">
                                        Bayar Sekarang
                                    </button>
                                </div>
                                @endif
                            </div>
                            @empty
                            <span class="text-center">Tidak ada tagihan saat ini</span>
                            @endforelse
                        </div>

                        <div class="mt-3">
                            {{ $transaksi->links() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">Informasi Pembayaran</div>
                    <div class="card-body">
                        <h5>Petunjuk Pembayaran</h5>
                        <ol class="ps-3">
                            <li>Pilih tagihan yang ingin Anda bayar.</li>
                            <li>Klik tombol "Bayar Sekarang".</li>
                            <li>Anda dapat memilih untuk membayar secara tunai langsung atau melalui sistem.</li>
                            <li>
                                Jika membayar secara tunai, lakukan pembayaran langsung dan segera upload bukti pembayaran di bagian detail pembayaran.
                            </li>
                            <li>
                                Jika membayar melalui sistem, lakukan pembayaran sesuai instruksi yang muncul (misalnya memilih bank atau metode lain di Midtrans), kemudian screenshot bukti pembayaran dan upload di bagian detail pembayaran.
                            </li>
                            <li>Pembayaran Anda akan diverifikasi oleh admin setelah bukti pembayaran diunggah.</li>
                        </ol>
                        <div class="alert alert-info" role="alert">
                            <i class="bi bi-info-circle me-2"></i> Pembayaran akan diverifikasi oleh admin setelah bukti pembayaran diunggah.
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Kontak Bantuan</div>
                    <div class="card-body">
                        <p><i class="bi bi-telephone me-2"></i> (+62) 1234-5678</p>
                        <p><i class="bi bi-envelope me-2"></i> keuangan@kampus.ac.id</p>
                        <p><i class="bi bi-clock me-2"></i> Senin-Jumat, 08.00-16.00 WIB</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="paymentModalLabel">Konfirmasi Pembayaran</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="bi bi-credit-card-2-front text-primary" style="font-size: 3rem;"></i>
                        <h4 class="mt-2" id="paymentCategory">-</h4>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Total Pembayaran</span>
                                <span class="fw-bold text-primary" id="paymentAmount">-</span>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Dengan melanjutkan, Anda akan diarahkan ke halaman pembayaran Midtrans untuk menyelesaikan transaksi.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button id="pay-button" class="btn btn-primary" data-transaksi-id="">Bayar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection