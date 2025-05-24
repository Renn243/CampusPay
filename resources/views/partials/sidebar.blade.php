<div class="col-md-3 col-lg-2 sidebar p-0">
    <div class="d-flex justify-content-between align-items-center p-3 bg-primary">
        <h4 class="m-0">Campus Pay</h4>
        <button class="btn btn-primary d-md-none mobile-menu" type="button" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </button>
    </div>
    <div class="sidebar-menu p-3">
        <div class="text-center mb-4">
            <h6 class="mb-0">{{ Auth::user()->nama_lengkap }}</h6>
            <small>NIM: {{ Auth::user()->mahasiswa->nim }}</small>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link {{ request()->is('beranda') ? 'active' : '' }}" href="{{ url('beranda') }}">
                <i class="bi bi-house-door"></i> Beranda
            </a>
            <a class="nav-link {{ request()->is('pembayaran') ? 'active' : '' }}" href="{{ url('pembayaran') }}">
                <i class="bi bi-credit-card"></i> Pembayaran
            </a>
            <a class="nav-link {{ request()->is('riwayat') ? 'active' : '' }}" href="{{ url('riwayat') }}">
                <i class="bi bi-clock-history"></i> Riwayat Pembayaran
            </a>
            <a class="nav-link {{ request()->is('profile') ? 'active' : '' }}" href="{{ url('profile') }}">
                <i class="bi bi-person"></i> Profile
            </a>
            <a class="nav-link" href="{{ route('logout') }}" id="logout-link">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </nav>
    </div>
</div>

<script>
    document.getElementById('logout-link').addEventListener('click', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Apakah Anda yakin ingin keluar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            confirmButtonColor: '#0d6efd',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = this.href;
            }
        });
    });
</script>