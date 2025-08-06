<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Detail Stok Keluar</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td, th { padding: 8px; border: 1px solid #333; vertical-align: top; }
        .img-container img { max-width: 150px; max-height: 150px; }
    </style>
</head>
<body>
    <h2>Detail Stok Keluar</h2>
    
    <table>
        <tr>
            <th>Foto Barang</th>
            <td class="img-container">
                <img src="{{ public_path('storage/' . $stock_keluars->barang->foto) }}" alt="Foto Barang">
            </td>
        </tr>
        <tr>
            <th>Nama Barang</th>
            <td>{{ $stock_keluars->barang->nama_barang }}</td>
        </tr>
        <tr>
            <th>Kategori</th>
            <td>{{ $stock_keluars->barang->kategori->nama_kategori ?? '-' }}</td>
        </tr>
        <tr>
            <th>Suplier</th>
            <td>{{ $stock_keluars->barang->suplier->nama_suplier ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tanggal Keluar</th>
            <td>{{ $stock_keluars->tanggal_keluar }}</td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td>{{ $stock_keluars->jumlah }}</td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td>{{ $stock_keluars->keterangan ?? '-' }}</td>
        </tr>
    </table>
</body>
</html>
