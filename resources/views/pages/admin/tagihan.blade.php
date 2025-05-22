@extends('layouts.admin')

@section('content')
<div id="tagihan">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0" id="page-title">Tagihan</h2>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0">Kelola Jadwal Tagihan</h5>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-md-end">
                        <div class="search-box me-2">
                            <i class="bi bi-search"></i>
                            <input type="text" class="form-control" placeholder="Cari tagihan...">
                        </div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addJadwalTagihanModal">
                            <i class="bi bi-plus-lg"></i> Tambah
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nama Tagihan</th>
                            <th>Kategori</th>
                            <th>Nominal</th>
                            <th>Tanggal Mulai</th>
                            <th>Batas Waktu</th>
                            <th>Target</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tagihan as $item)
                        <tr>
                            <td>{{ $item->nama_tagihan }}</td>
                            <td><span class="badge bg-primary">{{ $item->kategori }}</span></td>
                            <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->batas_waktu)->format('d M Y') }}</td>
                            <td>{{ $item->angkatan }}</td>
                            <td>
                                <div class="action-buttons d-flex gap-1">
                                    <!-- <a href="{{ route('admin.detailTagihan', $item->id_tagihan) }}" class="btn btn-sm btn-primary" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a> -->
                                    <a href="#"
                                        class="btn btn-sm btn-warning btn-edit-tagihan"
                                        data-id="{{ $item->id_tagihan }}"
                                        data-nama="{{ $item->nama_tagihan }}"
                                        data-kategori="{{ $item->kategori }}"
                                        data-nominal="{{ $item->nominal }}"
                                        data-tanggal_mulai="{{ $item->tanggal_mulai }}"
                                        data-batas_waktu="{{ $item->batas_waktu }}"
                                        data-angkatan="{{ $item->angkatan }}"
                                        title="Edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editJadwalTagihanModal">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.deleteTagihan', $item->id_tagihan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tagihan ini?')" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" title="Hapus" type="submit">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $tagihan->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<!-- Add Tagihan Modal -->
<div class="modal fade" id="addJadwalTagihanModal" tabindex="-1" aria-labelledby="addJadwalTagihanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addJadwalTagihanModalLabel">Tambah Jadwal Tagihan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.tambahTagihan') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_tagihan" class="form-label required-field">Nama Tagihan</label>
                        <input type="text" class="form-control" id="nama_tagihan" name="nama_tagihan" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="kategori" class="form-label required-field">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori" required>
                                <option value="" selected disabled>Pilih Kategori</option>
                                <option value="spp">SPP</option>
                                <option value="kkn">KKN</option>
                                <option value="ujian">Ujian</option>
                                <option value="wisuda">Wisuda</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="nominalTagihan" class="form-label required-field">Nominal</label>
                            <input type="number" class="form-control" id="nominal" name="nominal" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggal_mulai" class="form-label required-field">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_batas" class="form-label required-field">Tanggal Batas waktu</label>
                            <input type="date" class="form-control" id="tanggal_batas" name="tanggal_batas" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="angkatan" class="form-label required-field">Target Mahasiswa</label>
                        <select class="form-select" id="angkatan" name="angkatan" required>
                            <option value="" selected disabled>Pilih Target</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Tagihan Modal -->
<div class="modal fade" id="editJadwalTagihanModal" tabindex="-1" aria-labelledby="editJadwalTagihanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editTagihanForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editJadwalTagihanModalLabel">Edit Jadwal Tagihan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id_tagihan">
                    <div class="mb-3">
                        <label for="edit_nama_tagihan" class="form-label">Nama Tagihan</label>
                        <input type="text" class="form-control" id="edit_nama_tagihan" name="nama_tagihan">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="kategori" class="form-label required-field">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori" required>
                                <option value="" selected disabled>Pilih Kategori</option>
                                <option value="spp">SPP</option>
                                <option value="kkn">KKN</option>
                                <option value="ujian">Ujian</option>
                                <option value="wisuda">Wisuda</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="nominalTagihan" class="form-label required-field">Nominal</label>
                            <input type="number" class="form-control" id="nominal" name="nominal" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggal_mulai" class="form-label required-field">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_batas" class="form-label required-field">Tanggal Batas waktu</label>
                            <input type="date" class="form-control" id="tanggal_batas" name="tanggal_batas" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="angkatan" class="form-label required-field">Target Mahasiswa</label>
                        <select class="form-select" id="angkatan" name="angkatan" required>
                            <option value="" selected disabled>Pilih Target</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.btn-edit-tagihan');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const nama = this.dataset.nama;
                const kategori = this.dataset.kategori;
                const nominal = this.dataset.nominal;
                const tanggalMulai = this.dataset.tanggal_mulai;
                const batasWaktu = this.dataset.batas_waktu;
                const angkatan = this.dataset.angkatan;

                document.getElementById('edit_id').value = id;
                document.getElementById('edit_nama_tagihan').value = nama;
                document.getElementById('kategori').value = kategori;
                document.getElementById('nominal').value = nominal;
                document.getElementById('tanggal_mulai').value = tanggalMulai;
                document.getElementById('tanggal_batas').value = batasWaktu;
                document.getElementById('angkatan').value = angkatan;

                document.getElementById('editTagihanForm').action = `/admin/tagihan/${id}`;
            });
        });
    });
</script>
@endsection