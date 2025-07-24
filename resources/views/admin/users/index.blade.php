@extends('admin.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg rounded-3">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="card-title mb-0 text-primary fw-bold">
                        <i class="fas fa-users me-2"></i>Daftar Pengguna
                    </h5>
                    @can('add users')
                    <a href="{{ route('users.create') }}" class="btn btn-primary shadow-sm">
                        <i class="fas fa-plus me-2"></i>Tambah Pengguna
                    </a>
                    @endcan
                </div>
                <div class="card-body px-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    <div class="mb-3 row">
                        <label for="search" class="col-md-2 col-form-label fw-semibold">Cari</label>
                        <div class="col-md-8">
                            <input class="form-control shadow-sm" type="text" placeholder="Cari berdasarkan NIK, Nama, atau Jabatan..." id="search-input" />
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary w-100" id="search-button">
                                <i class="fas fa-search me-1"></i> Cari
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle" id="usersTable">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Tanggal</th>
                                    <th>Position</th>
                                    <th>Masuk Jadwal</th>
                                    <th>Kecelakaan</th>
                                    <th>Mulai Kerja</th>
                                    <th>Role</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->nik }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->tanggal }}</td>
                                    <td>{{ $user->position }}</td>
                                    <td>{{ $user->masuk_jadwal }}</td>
                                    <td>{{ $user->kecelakaan ?? '-' }}</td>
                                    <td>{{ $user->mulai_kerja }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <span class="badge bg-primary">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info">Aksi</button>
                                            <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                                              <span class="visually-hidden">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                @can('show users')
                                                <li>
                                                    <a href="{{ route('users.show', $user->id) }}" class="dropdown-item">
                                                        <i class="fas fa-eye text-info"></i> Detail
                                                    </a>
                                                </li>
                                                @endcan
                                                @can('edit users')
                                                <li>
                                                    <a href="{{ route('users.edit', $user->id) }}" class="dropdown-item">
                                                        <i class="fas fa-edit text-warning"></i> Edit
                                                    </a>
                                                </li>
                                                @endcan
                                                @can('delete users')
                                                <li>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                </li>
                                                @endcan
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        let table = $('#usersTable').DataTable({
            paging: true,
            ordering: true,
            info: true,
            lengthChange: false,
            language: {
                search: "Cari:",
                zeroRecords: "Tidak ada data yang ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ pengguna",
                infoEmpty: "Menampilkan 0 pengguna",
                paginate: {
                    previous: "Sebelumnya",
                    next: "Berikutnya"
                }
            },
            columnDefs: [
                { targets: [0], searchable: false }
            ]
        });

        function filterTable() {
            let searchText = $('#search-input').val().toLowerCase();
            table.rows().every(function() {
                let nik = this.data()[1].toLowerCase();
                let nama = this.data()[2].toLowerCase();
                let jabatan = this.data()[5].toLowerCase();

                if (nik.includes(searchText) || nama.includes(searchText) || jabatan.includes(searchText)) {
                    $(this.node()).show();
                } else {
                    $(this.node()).hide();
                }
            });
        }

        $('#search-button').on('click', function() {
            filterTable();
        });

        $('#search-input').on('keypress', function(event) {
            if (event.key === "Enter") {
                filterTable();
            }
        });
    });
</script>
@endpush
@endsection
