@extends('layouts.auth')

@section('content')
<div id="login-form">
    <h3>Login Mahasiswa</h3>

    <form action="#" method="post" id="loginForm">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="loginUsername" placeholder="NIM / Email"
                required>
            <label for="loginUsername">NIM / Email</label>
        </div>

        <div class="form-floating mb-3 password-field">
            <input type="password" class="form-control" id="loginPassword"
                placeholder="Password" required>
            <label for="loginPassword">Password</label>
            <span class="password-toggle" onclick="togglePassword('loginPassword')">
                <i class="bi bi-eye"></i>
            </span>
        </div>

        <div class="row mb-4">
            <div class="col-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">
                        Ingat Saya
                    </label>
                </div>
            </div>
            <div class="col-6 text-end">
                <a href="#" class="text-primary">Lupa Password?</a>
            </div>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-box-arrow-in-right me-2"></i> Masuk
            </button>
        </div>
    </form>
</div>
@endsection