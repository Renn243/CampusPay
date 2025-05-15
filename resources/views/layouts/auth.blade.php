<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Pay - Login & Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
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
                        <div class="auth-tabs">
                            <a href="{{ url('login') }}" class="text-decoration-none text-reset">
                                <div class="auth-tab {{ request()->is('login') ? 'active' : '' }}" id="login-tab">Login</div>
                            </a>
                            <a href="{{ url('register') }}" class="text-decoration-none text-reset">
                                <div class="auth-tab {{ request()->is('register') ? 'active' : '' }}" id="register-tab">Register</div>
                            </a>
                        </div>

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="text-center mt-4 text-muted">
            <p>&copy; 2025 Campus Pay. All rights reserved.</p>
        </div> -->
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/auth.js') }}"></script>
</body>

</html>