@extends('admin.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Data Stok Keluar</h4>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Card Data --}}
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><strong>Daftar Stok Keluar</strong></span>
            <a href="{{ route('stock_keluar.create') }}" class="btn btn-sm btn-primary">+ Tambah Stok Keluar</a>
        </div>

        <div class="card-body">
            @if($stock_keluars->isEmpty())
                <div class="alert alert-warning mb-0">Belum ada data stok keluar.</div>
            @else
                   <form action="{{ route('stock_keluar.index') }}" method="GET" class="row g-2 mb-4">
                    <div class="col-md-3">
                        <label>Tanggal Awal</label>
                        <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
                    </div>
                    <div class="col-md-3">
                        <label>Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                    @if(request('tanggal_awal') && request('tanggal_akhir'))
                    <div class="col-md-2 d-flex align-items-end">
                        <a href="{{ route('stock_keluar.cetak_filter', ['tanggal_awal' => request('tanggal_awal'), 'tanggal_akhir' => request('tanggal_akhir')]) }}" 
                        target="_blank" class="btn btn-success">Cetak PDF</a>
                    </div>
                    @endif
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Tanggal Keluar</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stock_keluars as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->barang->nama_barang }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d-m-Y') }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('stock_keluar.show', $item->id) }}" class="btn btn-sm btn-info">Detail</a>
                                        <form action="{{ route('stock_keluar.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-sm btn-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
