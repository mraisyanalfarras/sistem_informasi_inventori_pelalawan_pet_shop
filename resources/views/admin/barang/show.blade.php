@extends('admin.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Detail Barang</h4>
            <a href="{{ route('barang.index') }}" class="btn btn-sm btn-secondary">← Kembali</a>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4 text-center">
                @if ($barang->foto)
                        <img src="{{ asset('storage/' . $barang->foto) }}" alt="Foto Barang" class="img-thumbnail" width="200">
                    @else
                        <img src="https://via.placeholder.com/200x200.png?text=No+Image" alt="No Image" class="img-thumbnail">
                    @endif
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Nama Barang</th>
                            <td>{{ $barang->nama_barang }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Suplier</th>
                            <td>{{ $barang->suplier->nama_suplier ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>{{ $barang->stok }}</td>
                        </tr>
                        <tr>
                            <th>Harga Beli</th>
                            <td>Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Harga Jual</th>
                            <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Satuan</th>
                            <td>{{ $barang->satuan }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $barang->deskripsi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Dibuat Pada</th>
                            <td>{{ $barang->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Terakhir Diupdate</th>
                            <td>{{ $barang->updated_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
