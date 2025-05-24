// Sidebar Mobile
function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('show');
}

// Passing data ke modal pembayaran
paymentModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;

    const category = button.getAttribute('data-category');
    const amount = parseInt(button.getAttribute('data-amount'));
    const id = button.getAttribute('data-id');

    console.log("Data diterima:", category, amount, id);

    paymentModal.querySelector('#paymentCategory').textContent = category;
    paymentModal.querySelector('#paymentAmount').textContent = formatRupiah(amount);

    const payButton = paymentModal.querySelector('#pay-button');
    payButton.setAttribute('data-transaksi-id', id);
});

// Pembayaran midtrans
document.addEventListener('DOMContentLoaded', function () {
    const payButton = document.getElementById('pay-button');

    payButton.addEventListener('click', function () {
        const tagihanId = this.getAttribute('data-transaksi-id');
        payButton.disabled = true;
        console.log(tagihanId)
        fetch(`/pembayaran/${tagihanId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ id_tagihan: tagihanId })
        })
            .then(response => response.json())
            .then(data => {
                if (data.snap_token) {
                    snap.pay(data.snap_token, {
                        onSuccess: function (result) {
                            alert("Pembayaran berhasil");
                            document.getElementById('payment-modal').classList.add('hidden');
                            payButton.disabled = false;
                        },

                        onPending: function (result) {
                            alert("Pembayaran sedang diproses. Silakan cek status transaksi Anda.");
                            document.getElementById('payment-modal').classList.add('hidden');
                            payButton.disabled = false;
                        },
                        onError: function (result) {
                            alert("Pembayaran gagal: " + result.status_message);
                            document.getElementById('payment-modal').classList.add('hidden');
                            payButton.disabled = false;
                        },
                        onClose: function () {
                            alert("Anda menutup popup pembayaran. Jika ingin membayar, silakan coba kembali.");
                            document.getElementById('payment-modal').classList.add('hidden');
                            payButton.disabled = false;
                        },
                    });
                } else {
                    alert('Snap token tidak tersedia');
                    payButton.disabled = false;
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert('Terjadi kesalahan saat memulai pembayaran.');
                payButton.disabled = false;
            });
    });
});

// Fungsi format Rupiah
function formatRupiah(angka) {
    return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}



