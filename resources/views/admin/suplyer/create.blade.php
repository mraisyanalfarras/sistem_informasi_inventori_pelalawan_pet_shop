@extends('admin.app')

@section('content')
<div class="container mt-4">
    <div class="bg-white p-4 rounded shadow-sm">
        <h4 class="mb-4">Form Tambah Suplier</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('suplier.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Suplier</label>
                <input type="text" name="nama_suplier" class="form-control" value="{{ old('nama_suplier') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" name="telepon" class="form-control" value="{{ old('telepon') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('suplier.index') }}" class="btn btn-secondary me-2">Kembali</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
