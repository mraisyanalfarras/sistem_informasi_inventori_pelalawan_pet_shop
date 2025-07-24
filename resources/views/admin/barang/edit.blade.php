@extends('admin.app')
@section('content')
<div class="container">
    <h3>Edit Barang</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barang.update', $barang) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id', $barang->kategori_id) == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Suplier</label>
            <select name="suplier_id" class="form-control" required>
                <option value="">-- Pilih Suplier --</option>
                @foreach($supliers as $suplier)
                    <option value="{{ $suplier->id }}" {{ old('suplier_id', $barang->suplier_id) == $suplier->id ? 'selected' : '' }}>
                        {{ $suplier->nama_suplier }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ old('stok', $barang->stok) }}" required>
        </div>

        <div class="mb-3">
            <label>Harga Beli</label>
            <input type="number" name="harga_beli" class="form-control" value="{{ old('harga_beli', $barang->harga_beli) }}" required>
        </div>

        <div class="mb-3">
            <label>Harga Jual</label>
            <input type="number" name="harga_jual" class="form-control" value="{{ old('harga_jual', $barang->harga_jual) }}" required>
        </div>

        <div class="mb-3">
            <label>Satuan</label>
            <input type="text" name="satuan" class="form-control" value="{{ old('satuan', $barang->satuan) }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Foto Barang</label><br>
            @if($barang->foto_barang)
                <img src="{{ asset('storage/'.$barang->foto_barang) }}" width="100" class="mb-2"><br>
            @endif
            <input type="file" name="foto_barang" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
