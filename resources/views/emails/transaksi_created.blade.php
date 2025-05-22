<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Transaksi Pembayaran</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .email-container {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #0055A4;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            background-color: #fff;
            padding: 30px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .message {
            margin-bottom: 25px;
        }
        .transaction-details {
            background-color: #f9f9f9;
            border-radius: 6px;
            padding: 20px 25px;
            margin-bottom: 25px;
        }
        .transaction-item {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            margin: 5px 0;
        }
        .transaction-item:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: 600;
            color: #555;
            font-size: 15px;
        }
        .value {
            font-weight: 500;
            font-size: 15px;
        }
        .status-pending {
            color: #FF8C00;
            font-weight: bold;
        }
        .deadline {
            background-color: #FFF3CD;
            border-left: 4px solid #FF8C00;
            padding: 10px 15px;
            margin: 20px 0;
        }
        .orange-line {
            height: 3px;
            background-color: #FF8C00;
            width: 100%;
            margin: 20px 0;
        }
        .email-footer {
            background-color: #f3f3f3;
            padding: 15px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .logo {
            margin-bottom: 15px;
            font-size: 28px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <div class="logo">UNIVERSITAS</div>
            <h1>Notifikasi Pembayaran</h1>
        </div>
        
        <div class="email-body">
            <div class="greeting">
                Halo, <strong>{{ $transaksi->mahasiswa->nama_mahasiswa }}</strong>!
            </div>
            
            <div class="message">
                Berikut adalah rincian transaksi Anda:
            </div>

            <div class="transaction-details">
                <div class="transaction-item-stacked">
                    <div class="label">Tagihan</div>
                    <div class="value">{{ $transaksi->tagihan->nama_tagihan }}</div>
                </div>
                <hr>
                <div class="transaction-item-stacked">
                    <div class="label">Jumlah Bayar</div>
                    <div class="value">Rp{{ number_format($transaksi->jumlah_bayar, 0, ',', '.') }}</div>
                </div>
                <hr>
                <div class="transaction-item-stacked">
                    <div class="label">Status</div>
                    <div class="value status-pending">{{ $transaksi->status }}</div>
                </div>
                <hr>
            </div>
            
            <div class="deadline">
                <strong>⏰ Batas Waktu Pembayaran:</strong> {{ $transaksi->tagihan->tanggal_batas }}
            </div>
            
            <div class="message">
                Silakan lakukan pembayaran sesuai dengan nominal di atas sebelum batas waktu yang ditentukan untuk menghindari denda keterlambatan.
            </div>
            
            <div class="orange-line"></div>
            
        </div>
        
        <div class="email-footer">
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p>&copy; 2025 Universitas. Seluruh hak cipta dilindungi.</p>
        </div>
    </div>
</body>
</html>