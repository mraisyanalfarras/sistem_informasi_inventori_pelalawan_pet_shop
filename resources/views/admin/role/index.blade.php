@extends('admin.app')

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Manajemen Roles</h3>
            <!-- Tombol Tambah Role -->
            @can('add roles')
            <button type="button" class="btn btn-light text-primary fw-bold" onclick="window.location='{{ route('roles.create') }}'">
                <i class="fas fa-plus me-2"></i>Tambah Role
            </button>
            @endcan
        </div>
        <div class="card-body">
            <!-- Tabel Daftar Roles -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 20%;">Role</th>
                            <th style="width: 50%;">Permissions</th>
                            <th style="width: 25%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $role)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td> <!-- Penomoran -->
                                <td>{{ $role->name }}</td> <!-- Nama Role -->
                                <td>
                                    <!-- Daftar Permissions -->
                                    @foreach($role->permissions as $permission)
                                        <span class="badge bg-primary me-1 mb-1">{{ $permission->name }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <!-- Tombol Aksi -->
                                    <div class="d-flex justify-content-center gap-2">
                                        @can('edit roles')
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        @endcan

                                        @can('delete roles')
                                        <!-- Tombol Delete -->
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus role ini? Tindakan ini tidak dapat dibatalkan.')">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Tidak ada role yang tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
