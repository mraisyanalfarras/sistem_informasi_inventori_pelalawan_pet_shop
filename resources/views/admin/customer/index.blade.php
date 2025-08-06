@extends('admin.app')
@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">👥 Data Customer</h4>
            <a href="{{ route('customer.create') }}" class="btn btn-success">
                
                <i class="bi bi-plus-circle"></i> Tambah Customer
            </a>
        </div>

        <div class="card-body">
          <!-- Dropdown Filter -->
<div class="dropdown mb-3">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Filter & Pencarian
    </button>
    <div class="dropdown-menu p-4" style="min-width: 300px;">
        <form method="GET" action="{{ route('customer.index') }}">
            <div class="mb-3">
                <label for="kode_customer" class="form-label">Kode Customer</label>
                <input type="text" class="form-control" name="kode_customer" value="{{ request('kode_customer') }}" placeholder="Masukkan kode customer...">
                <label for="search" class="form-label">Cari Nama</label>
                <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Masukkan nama...">
            </div>

            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select">
                    <option value="">-- Semua --</option>
                    <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="per_page" class="form-label">Jumlah Data</label>
                <select name="per_page" class="form-select">
                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5 entri</option>
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 entri</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 entri</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 entri</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Terapkan</button>
                <a href="{{ route('customer.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>


            {{-- Alert Success --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Kode Customer</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                        <tr>
                            <td class="text-center">{{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->iteration }}</td>
                            <td>{{ $customer->kode_customer }}</td>
                            <td>{{ $customer->nama_customer }}</td>
                            <td>{{ $customer->alamat }}</td>
                            <td>{{ $customer->telepon }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->jenis_kelamin }}</td>
                            <td class="text-center">
                                <a href="{{ route('customer.show', $customer) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('customer.edit', $customer) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('customer.destroy', $customer) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada data customer.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    Menampilkan {{ $customers->firstItem() }} - {{ $customers->lastItem() }} dari {{ $customers->total() }} entri
                </div>
                <div>
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
