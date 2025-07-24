@extends('admin.app')
@section('content')
<div class="container">
    <h3>Data Kategori</h3>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategoris as $kategori)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kategori->nama_kategori }}</td>
                <td>{{ $kategori->deskripsi }}</td>
                <td>
                    <a href="{{ route('kategori.show', $kategori) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada data kategori.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
