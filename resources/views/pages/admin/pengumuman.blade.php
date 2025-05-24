@extends('layouts.admin')

@section('content')
<div id="pengumuman">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0" id="page-title">Pengumuman</h2>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0">Kelola Pengumuman</h5>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-md-end">
                        <form method="GET" action="{{ route('admin.listPengumuman') }}">
                            <div class="search-box me-2 d-flex align-items-center">
                                <i class="bi bi-search me-2"></i>
                                <input type="text" name="search" class="form-control" placeholder="Cari pengumuman..." value="{{ request('search') }}">
                            </div>
                        </form>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPengumumanModal">
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
                            <th>Judul</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengumuman as $item)
                        <tr>
                            <td>{{ $item->judul }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_batas)->translatedFormat('d F Y') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.detailPengumuman', $item->id_pengumuman) }}" class="text-decoration-none">
                                        <button class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </a>
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editPengumumanModal"
                                        data-id="{{ $item->id_pengumuman }}"
                                        data-judul="{{ $item->judul }}"
                                        data-mulai="{{ $item->tanggal_mulai }}"
                                        data-selesai="{{ $item->tanggal_selesai }}"
                                        data-deskripsi="{{ $item->deskripsi }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form id="delete-pengumuman-form-{{ $item->id_pengumuman }}" action="{{ route('admin.deletePengumuman', $item->id_pengumuman) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Data pengumuman tidak tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $pengumuman->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<!-- Add Pengumuman Modal -->
<div class="modal fade" id="addPengumumanModal" tabindex="-1" aria-labelledby="addPengumumanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPengumumanModalLabel">Tambah Pengumuman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPengumumanForm" action="{{ route('admin.tambahPengumuman') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="judul" class="form-label required-field">Judul Pengumuman</label>
                        <input type="text" name="judul" class="form-control" id="judul" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggal_mulai" class="form-label required-field">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control" id="tanggal_mulai" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_selesai" class="form-label required-field">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control" id="tanggal_selesai" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label required-field">Isi Pengumuman</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5" required></textarea>
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

<!-- Edit Pengumuman Modal -->
<div class="modal fade" id="editPengumumanModal" tabindex="-1" aria-labelledby="editPengumumanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPengumumanModalLabel">Edit Pengumuman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPengumumanForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" id="edit-judul" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit-mulai" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" name="tanggal_mulai" id="edit-mulai" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-selesai" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control" name="tanggal_selesai" id="edit-selesai" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit-deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="edit-deskripsi" rows="5" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Passing data ke modal edit
    const editModal = document.getElementById('editPengumumanModal');
    editModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');
        const judul = button.getAttribute('data-judul');
        const mulai = button.getAttribute('data-mulai');
        const selesai = button.getAttribute('data-selesai');
        const deskripsi = button.getAttribute('data-deskripsi');

        editModal.querySelector('#edit-id').value = id;
        editModal.querySelector('#edit-judul').value = judul;
        editModal.querySelector('#edit-mulai').value = mulai;
        editModal.querySelector('#edit-selesai').value = selesai;
        editModal.querySelector('#edit-deskripsi').value = deskripsi;

        editModal.querySelector('#editPengumumanForm').action = `/admin/pengumuman/${id}`;
    });

    document.querySelectorAll('form[id^="delete-pengumuman-form-"]').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Hapus pengumuman ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#0d6efd'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection