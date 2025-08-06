@extends('admin.app')
@section('content')
<div class="container">
    <h3>Detail Suplier</h3>

    <div class="card p-3">
        <p><strong>Nama Suplier:</strong> {{ $suplier->nama_suplier }}</p>
        <p><strong>Alamat:</strong> {{ $suplier->alamat }}</p>
        <p><strong>Telepon:</strong> {{ $suplier->telepon }}</p>
        <p><strong>Email:</strong> {{ $suplier->email }}</p>

        <a href="{{ route('suplier.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
