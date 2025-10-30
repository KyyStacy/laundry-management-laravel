<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Baru - Reed Code Laundry</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #e5e7eb;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
        }
        .container {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(139, 92, 246, 0.3);
            overflow: hidden;
            border: 1px solid rgba(139, 92, 246, 0.2);
        }
        .header {
            background: linear-gradient(135deg, #06b6d4 0%, #8b5cf6 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .content {
            padding: 30px;
        }
        h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        h2 {
            background: linear-gradient(135deg, #06b6d4 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 20px;
            margin-top: 30px;
            margin-bottom: 15px;
            font-weight: 700;
        }
        p {
            margin: 10px 0;
            color: #d1d5db;
        }
        strong {
            color: #06b6d4;
        }
        .order-item {
            background: rgba(139, 92, 246, 0.1);
            border-left: 4px solid #8b5cf6;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
        }
        .total {
            font-weight: bold;
            margin-top: 20px;
            font-size: 20px;
            color: #10b981;
        }
        .note {
            font-style: italic;
            color: #fbbf24;
            font-size: 14px;
            background: rgba(251, 191, 36, 0.1);
            padding: 10px;
            border-radius: 6px;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #9ca3af;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pesanan Baru</h1>
        </div>
        <div class="content">
            <p><strong>ID Pesanan:</strong> {{ $order->id_order }}</p>
            <p><strong>Nama:</strong> {{ $order->address->name }}</p>
            <p><strong>Alamat:</strong> {{ $order->address->alamat }}</p>
            <p><strong>WhatsApp:</strong> {{ $order->address->whatsapp }}</p>
            <p><strong>Jadwal Penjemputan:</strong> {{ $order->jadwal_penjemputan->format('d-m-Y H:i') }}</p>
            <p><strong>Jadwal Pengantaran:</strong> {{ $order->jadwal_pengantaran->format('d-m-Y') }} (15.00-21.00)</p>
            
            <h2>Detail Pesanan</h2>
            @php $total = 0; $hasPakaianBelumDitimbang = false; @endphp
            @foreach($order->orderDetails as $detail)
                <div class="order-item">
                    @if(in_array($detail->jenis_laundry, ['Pakaian Reguler', 'Pakaian Ekspress']))
                        @if($detail->jumlah == 0)
                            <p>{{ $detail->jenis_laundry }}</p>
                            <p class="note">Akan ditimbang saat penjemputan</p>
                            @php $hasPakaianBelumDitimbang = true; @endphp
                        @else
                            <p>{{ $detail->jenis_laundry }} - {{ $detail->jumlah }} Kg</p>
                            <p>Rp{{ number_format($detail->harga, 0, ',', '.') }}</p>
                            @php $total += $detail->harga; @endphp
                        @endif
                    @else
                        <p>{{ $detail->jenis_laundry }} - {{ $detail->jumlah }} Pcs</p>
                        <p>Rp{{ number_format($detail->harga, 0, ',', '.') }}</p>
                        @php $total += $detail->harga; @endphp
                    @endif
                </div>
            @endforeach
            
            <div class="total">
                Total: Rp{{ number_format($total, 0, ',', '.') }}
            </div>
            @if($hasPakaianBelumDitimbang)
                <p class="note">*Belum termasuk harga pakaian yang akan ditimbang saat penjemputan</p>
            @endif
        </div>
        <div class="footer">
            <p>Reed Code Laundry</p>
            <p>WhatsApp: +62 851-7171-3355 | Instagram & TikTok: @reedcode.id</p>
        </div>
    </div>
</body>
</html>