@extends('layouts.auth')

@section('content')
<div id="login-form">
    <h3>Daftar Akun Baru</h3>

    <form action="#" method="post" id="registerForm">
        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="registerName"
                        placeholder="Nama Lengkap" required>
                    <label for="registerName">Nama Lengkap</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="registerNIM" placeholder="NIM"
                        required>
                    <label for="registerNIM">NIM</label>
                </div>
            </div>
        </div>

        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="registerEmail" placeholder="Email"
                required>
            <label for="registerEmail">Email</label>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3 password-field">
                    <input type="password" class="form-control" id="registerPassword"
                        placeholder="Password" required>
                    <label for="registerPassword">Password</label>
                    <span class="password-toggle" onclick="togglePassword('registerPassword')">
                        <i class="bi bi-eye"></i>
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3 password-field">
                    <input type="password" class="form-control" id="registerConfirmPassword"
                        placeholder="Konfirmasi Password" required>
                    <label for="registerConfirmPassword">Konfirmasi Password</label>
                    <span class="password-toggle"
                        onclick="togglePassword('registerConfirmPassword')">
                        <i class="bi bi-eye"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-floating mb-3">
            <select class="form-select" id="registerFaculty" required>
                <option value="" selected disabled>Pilih Fakultas</option>
                <option value="teknik">Fakultas Teknik</option>
                <option value="ekonomi">Fakultas Ekonomi dan Bisnis</option>
                <option value="kedokteran">Fakultas Kedokteran</option>
                <option value="hukum">Fakultas Hukum</option>
                <option value="fisip">Fakultas Ilmu Sosial dan Politik</option>
            </select>
            <label for="registerFaculty">Fakultas</label>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-person-plus me-2"></i> Daftar
            </button>
        </div>
    </form>

    <div class="auth-footer">
        <p>Sudah memiliki akun? <a href="{{ url('#') }}" onclick="switchTab('login')">Masuk Sekarang</a></p>
    </div>
</div>
@endsection