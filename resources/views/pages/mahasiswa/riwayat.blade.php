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
                            <tr>
                                <td>PAY-20230815-001</td>
                                <td>15 Agustus 2023</td>
                                <td>SPP Semester Ganjil</td>
                                <td>Rp 5.000.000</td>
                                <td><span class="badge bg-success">Disetujui</span></td>
                                <td>
                                    <a href="{{ url('detailPembayaran') }}"><button class="btn btn-sm btn-primary">Detail</button></a>
                                </td>
                            </tr>
                            <tr>
                                <td>PAY-20230720-002</td>
                                <td>20 Juli 2023</td>
                                <td>KKN</td>
                                <td>Rp 2.500.000</td>
                                <td><span class="badge bg-success">Disetujui</span></td>
                                <td>
                                    <a href="{{ url('detailPembayaran') }}"><button class="btn btn-sm btn-primary">Detail</button></a>
                                </td>
                            </tr>
                            <tr>
                                <td>PAY-20230905-003</td>
                                <td>5 September 2023</td>
                                <td>Ujian Proposal</td>
                                <td>Rp 750.000</td>
                                <td><span class="badge bg-warning text-dark">Menunggu</span></td>
                                <td>
                                    <a href="{{ url('detailPembayaran') }}"><button class="btn btn-sm btn-primary">Detail</button></a>
                                </td>
                            </tr>
                            <tr>
                                <td>PAY-20230610-004</td>
                                <td>10 Juni 2023</td>
                                <td>Praktikum</td>
                                <td>Rp 1.200.000</td>
                                <td><span class="badge bg-success">Disetujui</span></td>
                                <td>
                                    <a href="{{ url('detailPembayaran') }}"><button class="btn btn-sm btn-primary">Detail</button></a>
                                </td>
                            </tr>
                            <tr>
                                <td>PAY-20230505-005</td>
                                <td>5 Mei 2023</td>
                                <td>SPP Semester Genap</td>
                                <td>Rp 5.000.000</td>
                                <td><span class="badge bg-success">Disetujui</span></td>
                                <td>
                                    <a href="{{ url('detailPembayaran') }}"><button class="btn btn-sm btn-primary">Detail</button></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="{{ url('#') }}" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="{{ url('#') }}">1</a></li>
                        <li class="page-item"><a class="page-link" href="{{ url('#') }}">2</a></li>
                        <li class="page-item"><a class="page-link" href="{{ url('#') }}">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="{{ url('#') }}">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection