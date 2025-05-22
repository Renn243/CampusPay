@extends('layouts.mahasiswa')

@section('content')
<div class="col-md-9 col-lg-10 ms-sm-auto content p-4">
    <div id="profile" class="page">
        <h2 class="mb-4">Profile</h2>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="mb-3">
                            <i class="bi bi-person-circle" style="font-size: 4rem;"></i>
                        </div>
                        {{-- Nama Mahasiswa --}}
                        <h5>{{ $user->mahasiswa->nama_mahasiswa ?? 'Tidak tersedia' }}</h5>
                        {{-- NIM --}}
                        <p class="text-muted mb-1">NIM: {{ $user->mahasiswa->nim ?? '-' }}</p>
                        <div class="d-flex justify-content-center mt-2">
                            <span class="badge {{ strtolower($user->mahasiswa->status ?? '') == 'aktif' ? 'bg-success' : 'bg-danger' }} me-2">
                                {{ $user->mahasiswa->status ?? '-' }}
                            </span>
                            <span class="badge bg-primary">{{ $user->mahasiswa->angkatan ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">Akademik</div>
                    <div class="card-body">
                        <p><i class="bi bi-mortarboard-fill me-2 text-primary"></i><strong>Fakultas:</strong><br> {{ $user->mahasiswa->fakultas ?? '-' }}</p>
                        <p><i class="bi bi-journal-code me-2 text-primary"></i><strong>Program Studi:</strong><br> {{ $user->mahasiswa->program_studi ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Informasi Pribadi</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p><i class="bi bi-person-fill me-2 text-secondary"></i><strong>Nama:</strong><br> {{ $user->mahasiswa->nama_mahasiswa ?? '-' }}</p>
                                <p><i class="bi bi-calendar-event-fill me-2 text-secondary"></i><strong>Tanggal Lahir:</strong><br>
                                    {{ $user->mahasiswa->tanggal_lahir ? \Carbon\Carbon::parse($user->mahasiswa->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                                </p>
                                <p><i class="bi bi-geo-alt me-2 text-secondary"></i><strong>Tempat Lahir:</strong><br> {{ $user->mahasiswa->tempat_lahir ?? '-' }}</p>
                                <p><i class="bi bi-gender-ambiguous me-2 text-secondary"></i><strong>Jenis Kelamin:</strong><br>
                                    {{ isset($user->mahasiswa->jenis_kelamin) ? ($user->mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan') : '-' }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><i class="bi bi-bookmark-star-fill me-2 text-secondary"></i><strong>Agama:</strong><br> {{ $user->mahasiswa->agama ? ucfirst($user->mahasiswa->agama) : '-' }}</p>
                                <p><i class="bi bi-geo-alt-fill me-2 text-secondary"></i><strong>Alamat:</strong><br> {{ $user->mahasiswa->alamat ?? '-' }}</p>
                                <p><i class="bi bi-telephone-fill me-2 text-secondary"></i><strong>No. Telp:</strong><br> {{ $user->mahasiswa->no_telp ?? '-' }}</p>
                                <p><i class="bi bi-envelope-fill me-2 text-secondary"></i><strong>Email:</strong><br> {{ $user->email ?? '-' }}</p>
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