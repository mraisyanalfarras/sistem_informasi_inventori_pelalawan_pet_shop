@extends('admin.app')
@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">📦 Data Suplier</h4>
            <a href="{{ route('suplier.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Suplier
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Suplier</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($supliers as $suplier)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $suplier->nama_suplier }}</td>
                            <td>{{ $suplier->alamat }}</td>
                            <td>{{ $suplier->telepon }}</td>
                            <td>{{ $suplier->email }}</td>
                            <td class="text-center">
                                <a href="{{ route('suplier.show', $suplier) }}" class="btn btn-info btn-sm me-1">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('suplier.edit', $suplier) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('suplier.destroy', $suplier) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data suplier.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
