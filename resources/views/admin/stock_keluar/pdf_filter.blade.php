<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Stok Keluar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        h2, h4 {
            text-align: center;
            margin: 0;
        }

        .info {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>LAPORAN STOK KELUAR</h2>
    <h4>DI PELALAWAN PET SHOP</h4>

    <div class="info">
        <strong>Periode:</strong> 
        {{ request('tanggal_awal') }} s/d {{ request('tanggal_akhir') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Suplier</th>
                <th>Tanggal Keluar</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stock_keluars as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->barang->nama_barang }}</td>
                    <td>{{ $item->barang->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $item->barang->suplier->nama_suplier ?? '-' }}</td>
                    <td>{{ $item->tanggal_keluar }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="text-center" style="margin-top: 30px;">
        <small>Dicetak pada: {{ now()->format('d-m-Y H:i') }}</small>
    </div>

</body>
</html>
