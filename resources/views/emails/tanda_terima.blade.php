<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tanda Terima Pembayaran {{ $transaksi->order_id }}</title>
    <style>
        /* Reset margin/padding untuk cetak */
        @page { margin: 20mm }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            box-sizing: border-box;
        }
        .kampus-info h2 {
            margin: 0;
            font-size: 16px;
        }
        .kampus-info p {
            margin: 2px 0;
            font-size: 10px;
        }
        .document-title {
            text-align: center;
            margin: 20px 0;
        }
        .document-title h1 {
            font-size: 18px;
            margin: 0;
            text-decoration: underline;
        }
        .info-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 4px 6px;
        }
        .info-table td:first-child {
            width: 25%;
            font-weight: bold;
        }
        .payment-details {
            border: 1px solid #333;
            padding: 10px;
        }
        .payment-details .title {
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .payment-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
        }
        .payment-info.total {
            font-weight: bold;
            border-top: 1px solid #333;
            padding-top: 6px;
        }
        .status-stamp {
            position: absolute;
            top: 30mm;
            right: 20mm;
            font-size: 48px;
            color: rgba(0,0,0,0.1);
            transform: rotate(-20deg);
            z-index: 0;
        }
    </style>
</head>
<body>
    <div class="status-stamp">LUNAS</div>
    <div class="container">

        <div class="document-title">
            <h1>TANDA TERIMA PEMBAYARAN</h1>
        </div>

        <table class="info-table">
            <tr>
                <td>Nomor Transaksi</td>
                <td>: {{ $transaksi->order_id }}</td>
            </tr>
            <tr>
                <td>Tanggal Bayar</td>
                <td>: {{ \Carbon\Carbon::parse($transaksi->tanggal_bayar)->format('d M Y H:i') }}</td>
            </tr>
            <tr>
                <td>Nama Mahasiswa</td>
                <td>: {{ $transaksi->mahasiswa->nama_mahasiswa ?? '-' }}</td>
            </tr>
            <tr>
                <td>Nama Tagihan</td>
                <td>: {{ $transaksi->tagihan->nama_tagihan ?? '-' }}</td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td>: {{ ucfirst($transaksi->tagihan->kategori ?? '-') }}</td>
            </tr>
        </table>

        <div class="payment-details">
            <div class="title">DETAIL PEMBAYARAN</div>
            <div class="payment-info">
                <span>Metode Pembayaran</span>
                <span>{{ ucfirst($status->payment_type ?? '-') }}</span>
            </div>
            <div class="payment-info total">
                <span>TOTAL PEMBAYARAN</span>
                <span>Rp {{ number_format($status->gross_amount, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</body>
</html>
