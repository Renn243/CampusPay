<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusPay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/authStyle.css') }}">
</head>

<body>
    <div class="auth-container">
        <div class="card auth-card">
            <div class="row g-0">
                <!-- Banner -->
                <div class="col-md-5 auth-sidebar">
                    <div class="auth-logo">
                        <i class="bi bi-credit-card-2-front"></i> Campus Pay
                    </div>
                    <h2>Sistem Pembayaran Kampus</h2>
                    <p>Kelola pembayaran kuliah Anda dengan mudah, cepat, dan aman melalui Campus Pay.</p>
                </div>

                <!-- Forms -->
                <div class="col-md-7">
                    <div class="auth-form">
                        <div id="login-form">
                            <h3>Login</h3>

                            <form method="post" id="loginForm" action="{{ route('login') }}">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                                    <label for="email">Email</label>
                                </div>

                                <div class="form-floating mb-3 password-field">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    <label for="password">Password</label>
                                    <span class="password-toggle" onclick="togglePassword('password')">
                                        <i class="bi bi-eye"></i>
                                    </span>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-6">
                                        <a href="#" class="text-primary">Lupa Password?</a>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-box-arrow-in-right me-2"></i> Masuk
                                    </button>
                                </div>
                            </form>

                            @if(session('error'))
                            <p style="color:red;">{{ session('error') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/auth.js') }}"></script>
</body>

</html>