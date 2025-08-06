@extends('admin.app')
@section('content')
<div class="container">
    <h3>Detail Customer</h3>

    <div class="card p-3">
        <p><strong>Kode Customer:</strong> {{ $customer->kode_customer }}</p>
        <p><strong>Nama Customer:</strong> {{ $customer->nama_customer }}</p>
        <p><strong>Alamat:</strong> {{ $customer->alamat }}</p>
        <p><strong>Telepon:</strong> {{ $customer->telepon }}</p>
        <p><strong>Email:</strong> {{ $customer->email }}</p>
        <p><strong>Jenis Kelamin:</strong> {{ $customer->jenis_kelamin }}</p>
        <p><strong>Catatan:</strong> {{ $customer->catatan }}</p>

        <a href="{{ route('customer.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
