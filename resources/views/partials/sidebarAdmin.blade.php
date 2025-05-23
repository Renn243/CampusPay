<div class="col-md-3 col-lg-2 sidebar p-0">
    <div class="d-flex justify-content-between align-items-center p-3 bg-primary">
        <h4 class="m-0">Campus Pay</h4>
        <button class="btn btn-primary d-md-none mobile-menu" type="button" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </button>
    </div>
    <div class="sidebar-menu p-3">
        <div class="text-center mb-4">
            <h6 class="mb-0">Admin Keuangan</h6>
            <small>admin@campus.ac.id</small>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link {{ request()->is('admin/') ? 'active' : '' }}" href="{{ url('admin/') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->is('admin/mahasiswa') ? 'active' : '' }}" href="{{ url('admin/mahasiswa') }}">
                <i class="bi bi-people"></i> Mahasiswa
            </a>
            <a class="nav-link {{ request()->is('admin/pembayaran') ? 'active' : '' }}" href="{{ url('admin/pembayaran') }}">
                <i class="bi bi-credit-card"></i> Pembayaran
            </a>
            <a class="nav-link {{ request()->is('admin/pengumuman') ? 'active' : '' }}" href="{{ url('admin/pengumuman') }}">
                <i class="bi bi-megaphone"></i> Pengumuman
            </a>
            <a class="nav-link {{ request()->is('admin/tagihan') ? 'active' : '' }}" href="{{ url('admin/tagihan') }}">
                <i class="bi bi-calendar-check"></i> Jadwal Tagihan
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
            icon: 'question',
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