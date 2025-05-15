// Sidebar Mobile
function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('show');
}

// Format currency Rupiah
function formatRupiah(amount) {
    return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Payment
function proceedToPayment() {
    alert('Anda akan diarahkan ke halaman pembayaran Midtrans.');
    const modal = bootstrap.Modal.getInstance(document.getElementById('paymentModal'));
    if (modal) modal.hide();
}

// Save Profile
function saveProfile() {
    alert('Profile berhasil diperbarui!');
    const modal = bootstrap.Modal.getInstance(document.getElementById('editProfileModal'));
    if (modal) modal.hide();
}

// Change Password
function changePassword() {
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (newPassword !== confirmPassword) {
        alert('Password baru dan konfirmasi password tidak cocok!');
        return;
    }

    alert('Password berhasil diubah!');
    document.getElementById('passwordForm').reset();
    const modal = bootstrap.Modal.getInstance(document.getElementById('changePasswordModal'));
    if (modal) modal.hide();
}

// Payment Modal
function showPaymentModal(category, amount) {
    console.log("Menampilkan modal pembayaran:", category, amount);

    Swal.fire({
        title: 'Konfirmasi Pembayaran',
        html: `
        <div class="text-center mb-4">
            <i class="bi bi-credit-card-2-front text-primary" style="font-size: 3rem;"></i>
            <h4 class="mt-2">${category}</h4>
        </div>
        
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span>Nominal Tagihan</span>
                    <span class="fw-bold">${formatRupiah(amount)}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Biaya Admin</span>
                    <span>Rp 2.500</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span class="fw-bold">Total Pembayaran</span>
                    <span class="fw-bold text-primary">${formatRupiah(amount + 2500)}</span>
                </div>
            </div>
        </div>
        
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i> Dengan melanjutkan, Anda akan diarahkan ke halaman pembayaran Midtrans untuk menyelesaikan transaksi.
        </div>
    `,
        showCancelButton: true,
        confirmButtonText: 'Lanjutkan Pembayaran',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#0d6efd',
        cancelButtonColor: '#6c757d',
        customClass: {
            popup: 'swal2-payment-modal',
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-secondary'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            proceedToPayment();
        }
    });
}

// Initialize
document.addEventListener('DOMContentLoaded', function () {
    // Initialize payment buttons
    const paymentButtons = document.querySelectorAll('.btn-bayar');

    paymentButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const category = this.getAttribute('data-category');
            const amount = parseInt(this.getAttribute('data-amount'));
            console.log("Tombol pembayaran diklik:", category, amount);

            showPaymentModal(category, amount);
        });
    });
});
