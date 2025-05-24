<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Verifikasi Pembayaran</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #2c3e50;
            color: #fff;
            padding: 25px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
        }

        .content {
            padding: 30px;
        }

        .content p {
            font-size: 15px;
            margin-bottom: 20px;
        }

        .detail {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }

        .item {
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
            font-size: 14px;
        }

        .value {
            font-size: 14px;
            margin-top: 5px;
        }

        .badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 13px;
        }

        .status-lunas {
            background-color: #d4edda;
            color: #155724;
        }

        .status-ditolak {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-menunggu {
            background-color: #fff3cd;
            color: #856404;
        }

        .footer {
            background-color: #ecf0f1;
            text-align: center;
            padding: 20px;
            font-size: 13px;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Status Verifikasi Pembayaran</h1>
        </div>

        <div class="content">
            <p>Halo, <strong>{{ $tagihan->mahasiswa->nama_mahasiswa }}</strong>.</p>
            <p>Berikut adalah informasi terkait pembayaran tagihan Anda:</p>

            <div class="detail">
                <div class="item">
                    <div class="label">Nama Tagihan</div>
                    <div class="value">{{ $tagihan->tagihan->nama_tagihan }}</div>
                </div>

                <div class="item">
                    <div class="label">Status Verifikasi</div>
                    <div class="value">
                        @php
                        $status = strtolower($tagihan->status);
                        @endphp
                        <span class="badge
                            {{ $status === 'lunas' ? 'status-lunas' :
                               ($status === 'ditolak' ? 'status-ditolak' : 'status-menunggu') }}">
                            @if ($status === 'lunas')
                            Lunas (Disetujui)
                            @elseif ($status === 'ditolak')
                            Ditolak
                            @else
                            Menunggu Verifikasi
                            @endif
                        </span>
                    </div>
                </div>

                <div class="item">
                    <div class="label">Batas Pembayaran</div>
                    <div class="value">
                        {{ \Carbon\Carbon::parse($tagihan->tagihan->tanggal_batas)->translatedFormat('d F Y') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            Email ini dikirim otomatis. Jangan membalas email ini.<br>
            &copy; {{ date('Y') }} Universitas. Semua Hak Dilindungi.
        </div>
    </div>
</body>

</html>