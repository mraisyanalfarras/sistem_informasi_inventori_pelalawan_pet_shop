@extends('admin.app')

@section('content')
<div class="container">
    <h4>Detail Stok Keluar</h4>
    <a href="{{ route('stock_keluar.cetak_pdf', $stock_keluars->id) }}" class="btn btn-primary mt-2" target="_blank">Cetak PDF</a>
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Informasi Barang</h5>
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('storage/' . $stock_keluars->barang->foto) }}" alt="Gambar Barang" class="img-fluid rounded border">
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered mt-4">
                        <tr>
                            <th>Nama Barang</th>
                            <td> {{ $stock_keluars->barang->nama_barang }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td> {{ $stock_keluars->barang->kategori->nama_kategori ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Suplier</th>
                            <td> {{ $stock_keluars->barang->suplier->nama_suplier ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Keluar</th>
                            <td> {{ $stock_keluars->tanggal_keluar }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td> {{ $stock_keluars->jumlah }}</td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td> {{ $stock_keluars->keterangan ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('stock_keluar.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
 