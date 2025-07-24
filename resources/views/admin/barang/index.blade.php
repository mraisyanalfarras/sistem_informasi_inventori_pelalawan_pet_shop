@extends('admin.app')
@section('content')
<div class="container">
    <h3>Data Barang</h3>
    <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Suplier</th>
                <th>Stok</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Satuan</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangs as $barang)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if($barang->foto_barang)
                        <img src="{{ asset('storage/'.$barang->foto_barang) }}" width="50">
                    @else
                        -
                    @endif
                </td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->kategori->nama_kategori }}</td>
                <td>{{ $barang->suplier->nama_suplier }}</td>
                <td>{{ $barang->stok }}</td>
                <td>Rp {{ number_format($barang->harga_beli,0,',','.') }}</td>
                <td>Rp {{ number_format($barang->harga_jual,0,',','.') }}</td>
                <td>{{ $barang->satuan }}</td>
                <td>{{ $barang->deskripsi }}</td>
                <td>
                    <a href="{{ route('barang.show', $barang) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('barang.edit', $barang) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('barang.destroy', $barang) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
