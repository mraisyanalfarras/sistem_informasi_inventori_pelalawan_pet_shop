@extends('admin.app')

@section('content')
<div class="container">
    {{-- Card Header --}}
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-box-seam"></i> Data Barang</h5>
            <div>
                <a href="{{ route('barang.create') }}" class="btn btn-success me-2">
                    <i class="bi bi-plus-circle"></i> Tambah Barang
                </a>
                <a href="{{ route('export.barang', request()->query()) }}" class="btn btn-outline-success">
                    <i class="bi bi-file-earmark-excel"></i> Export Excel
                </a>
            </div>
        </div>
    </div>

    {{-- Card Filter --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-light">
            <strong><i class="bi bi-funnel-fill"></i> Filter & Search</strong>
        </div>
        <div class="card-body">
            <form method="GET">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-select">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoriOptions as $id => $nama)
                                <option value="{{ $id }}" {{ request('kategori_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="suplier_id" class="form-label">Suplier</label>
                        <select name="suplier_id" class="form-select">
                            <option value="">-- Pilih Suplier --</option>
                            @foreach($suplierOptions as $id => $nama)
                                <option value="{{ $id }}" {{ request('suplier_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="search" class="form-label">Cari Barang</label>
                        <input type="text" name="search" class="form-control" placeholder="Nama barang..." value="{{ request('search') }}">
                    </div>

                    <div class="col-md-3">
                        <label for="per_page" class="form-label">Tampilkan</label>
                        <select name="per_page" class="form-select">
                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-funnel"></i> Terapkan Filter
                    </button>
                    <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Card Tabel --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Suplier</th>
                            <th>Stok</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Satuan</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangs as $index => $barang)
                        <tr>
                        <td class="text-center">{{ $index + $barangs->firstItem() }}</td>
                        <td class="text-center">
                            @if($barang->foto)
                                <img src="{{ asset('storage/' . $barang->foto) }}" alt="Foto Barang" width="50">
                            @else
                                Tidak ada foto
                            @endif
                        </td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                            <td>{{ $barang->suplier->nama_suplier ?? '-' }}</td>
                            <td class="text-center">
                                <span class="badge bg-{{ $barang->stok < 10 ? 'danger' : 'success' }}">
                                    {{ $barang->stok }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $barang->satuan }}</td>
                            <td>{{ $barang->deskripsi }}</td>
                            <td class="text-center">
                                <a href="{{ route('barang.show', $barang->id) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted">Tidak ada data ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Info dan Pagination --}}
            <div class="d-flex justify-content-between align-items-center">
                <small>
                    Menampilkan <strong>{{ $barangs->firstItem() }}</strong> - <strong>{{ $barangs->lastItem() }}</strong>
                    dari <strong>{{ $barangs->total() }}</strong> data
                </small>
                <div>
                    {{ $barangs->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
