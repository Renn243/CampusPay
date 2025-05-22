@extends('layouts.mahasiswa')

@section('content')
<div class="col-md-9 col-lg-10 ms-sm-auto content p-4">
    <div id="profile" class="page">
        <h2 class="mb-4">Profile</h2>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5>Uzumaki Naruto</h5>
                        <p class="text-muted">NIM: 123456789</p>
                        <p class="mb-1"><i class="bi bi-envelope me-2"></i>uzumakinaruto@email.com</p>
                        <p class="mb-1"><i class="bi bi-telephone me-2"></i>+62 812-1234-5678</p>
                        <p><i class="bi bi-geo-alt me-2"></i>Makassar, Indonesia</p>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">Informasi Akademik</div>
                    <div class="card-body">
                        <p class="mb-2"><strong>Fakultas:</strong> Teknik</p>
                        <p class="mb-2"><strong>Program Studi:</strong> Teknik Informatika</p>
                        <p class="mb-2"><strong>Angkatan:</strong> 2020</p>
                        <p class="mb-2"><strong>Semester:</strong> 7</p>
                        <p class="mb-0"><strong>Status:</strong> <span class="badge bg-success">Aktif</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Informasi Mahasiswa</h4>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted">Nama Lengkap</label>
                                    <h6>Nama Mahasiswa</h6>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-muted">NIM</label>
                                    <h6>123456789</h6>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-muted">Program Studi</label>
                                    <h6>Teknik Informatika</h6>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-muted">Fakultas</label>
                                    <h6>Ilmu Komputer</h6>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted">Email</label>
                                    <h6>uzumakinaruto@email.com</h6>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-muted">Nomor Telepon</label>
                                    <h6>+62 812-1234-5678</h6>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-muted">Alamat</label>
                                    <h6>Jl. Semangka</h6>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-muted">Tanggal Lahir</label>
                                    <h6>01 Januari 2000</h6>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                <i class="bi bi-pencil-square me-2"></i> Edit Profile
                            </button>
                            <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                <i class="bi bi-key me-2"></i> Ubah Password
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Photo Modal -->
    <div class="modal fade" id="changePhotoModal" tabindex="-1" aria-labelledby="changePhotoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePhotoModalLabel">Ubah Foto Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <img src="https://via.placeholder.com/150" alt="Current Profile" class="profile-img mb-3">
                    </div>
                    <div class="mb-3">
                        <label for="profilePhoto" class="form-label">Pilih Foto Baru</label>
                        <input type="file" class="form-control" id="profilePhoto" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="profileForm">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fullName" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="fullName" value="Nama Mahasiswa">
                            </div>
                            <div class="col-md-6">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control" id="nim" value="123456789" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="mahasiswa@email.com">

                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Nomor Telepon</label>
                                <input type="tel" class="form-control" id="phone" value="+62 812-3456-7890">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control" id="address"
                                rows="3">Jl. Contoh No. 123, Jakarta Selatan, DKI Jakarta</textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="birthdate" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="birthdate" value="2000-01-01">
                            </div>
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="gender">
                                    <option value="male">Laki-laki</option>
                                    <option value="female">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="saveProfile()">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Ubah Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="passwordForm">
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Password Saat Ini</label>
                            <input type="password" class="form-control" id="currentPassword" required>
                        </div>

                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="newPassword" required>
                            <div class="form-text">Password minimal 8 karakter dengan kombinasi huruf dan angka.</div>
                        </div>

                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="confirmPassword" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="changePassword()">Ubah Password</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection