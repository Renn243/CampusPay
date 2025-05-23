// Sidebar Mobile
function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('show');
}

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

document.addEventListener('DOMContentLoaded', function () {
    const payButton = document.getElementById('pay-button');

    payButton.addEventListener('click', function () {
        const transaksiId = this.getAttribute('data-transaksi-id');
        payButton.disabled = true;
        fetch(`/pembayaran/${transaksiId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ id_transaksi: transaksiId })
        })
            .then(response => response.json())
            .then(data => {
                if (data.snap_token) {
                    snap.pay(data.snap_token, {
                        onSuccess: function (result) {
                            updateStatus(transaksiId, result, "Pembayaran berhasil!");
                            document.getElementById('payment-modal').classList.add('hidden');
                        },
                        onPending: function (result) {
                            updateStatus(transaksiId, result, "Pembayaran masih pending, silakan tunggu konfirmasi.");
                            document.getElementById('payment-modal').classList.add('hidden');
                        },
                        onError: function (result) {
                            alert("Gagal: " + result.status_message);
                            document.getElementById('payment-modal').classList.add('hidden');
                            payButton.disabled = false;
                        },
                        onClose: function () {
                            alert("Popup ditutup tanpa menyelesaikan pembayaran.");
                            document.getElementById('payment-modal').classList.add('hidden');
                            payButton.disabled = false;
                        }
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

        function updateStatus(id, result, message) {
            fetch(`/pembayaran/updateStatus/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ result: result })
            })
                .then(res => res.json())
                .then(resData => {
                    if (resData.success) {
                        alert(message);
                    } else {
                        alert('Gagal update status transaksi.');
                    }
                    payButton.disabled = false;
                })
                .catch(err => {
                    console.error('Error update status:', err);
                    alert('Terjadi kesalahan saat update status transaksi.');
                    payButton.disabled = false;
                });
        }
    });
});

// Fungsi format Rupiah
function formatRupiah(angka) {
    return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}



