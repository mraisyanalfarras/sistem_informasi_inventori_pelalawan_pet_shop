@extends('admin.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Edit Barang</h4>
            <a href="{{ route('barang.index') }}" class="btn btn-sm btn-secondary">← Kembali</a>
        </div>

        <div class="card-body">
            {{-- Error Handling --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label>Satuan</label>
                        <input type="text" name="satuan" class="form-control" value="{{ old('satuan', $barang->satuan) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Kategori</label>
                        <select name="kategori_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id', $barang->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Suplier</label>
                        <select name="suplier_id" class="form-select" required>
                            <option value="">-- Pilih Suplier --</option>
                            @foreach($supliers as $suplier)
                                <option value="{{ $suplier->id }}" {{ old('suplier_id', $barang->suplier_id) == $suplier->id ? 'selected' : '' }}>
                                    {{ $suplier->nama_suplier }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" value="{{ old('stok', $barang->stok) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label>Harga Beli</label>
                        <input type="number" name="harga_beli" class="form-control" value="{{ old('harga_beli', $barang->harga_beli) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label>Harga Jual</label>
                        <input type="number" name="harga_jual" class="form-control" value="{{ old('harga_jual', $barang->harga_jual) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Barang</label>
                    <input type="file" name="foto" class="form-control">
                    @if($barang->foto)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $barang->foto) }}" alt="Foto Barang" width="120">
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
