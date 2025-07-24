<!DOCTYPE html>
<html>
<head>
    <title>Promosi Spesial untuk Anda!</title>
    <style>
        /* Tambahkan gaya CSS di sini jika diperlukan */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            padding: 10px;
            background-color: #007bff;
            color: white;
        }
        .content {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $subject }}</h1>
        </div>
        <div class="content">
            <h2>Halo, {{ $customer->name }}</h2>
            <h3>{{ $title }}</h3>
            <p>{{ $description }}</p>
            <p>Periode Promosi: {{ \Carbon\Carbon::parse($promotion->start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($promotion->end_date)->format('d M Y') }}</p>
            <p>Jangan lewatkan kesempatan ini untuk mendapatkan penawaran terbaik dari kami!</p>
            <p>Terima kasih telah menjadi pelanggan setia kami.</p>
        </div>
    </div>
</body>
</html>