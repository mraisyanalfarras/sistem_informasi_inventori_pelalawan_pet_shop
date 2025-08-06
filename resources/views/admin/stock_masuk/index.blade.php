@extends('admin.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Data Stok Masuk</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><strong>Filter Data Stok Masuk</strong></span>
            <a href="{{ route('stock_masuk.create') }}" class="btn btn-sm btn-primary">+ Tambah Stok Masuk</a>
        </div>

        <div class="card-body">
            <form action="{{ route('stock_masuk.index') }}" method="GET" class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label>Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
                </div>
                <div class="col-md-3">
                    <label>Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
                @if(request('tanggal_awal') && request('tanggal_akhir'))
                    <div class="col-md-2">
                        <a href="{{ route('stock_masuk.cetakFilter', ['tanggal_awal' => request('tanggal_awal'), 'tanggal_akhir' => request('tanggal_akhir')]) }}"
                           target="_blank" class="btn btn-success w-100">Cetak PDF</a>
                    </div>
                @endif
            </form>
        </div>
    </div>

    {{-- TABEL DATA --}}
    <div class="card shadow-sm">
        <div class="card-header">
            <strong>Daftar Stok Masuk</strong>
        </div>

        <div class="card-body p-0">
            @if($stockMasuks->isEmpty())
                <div class="p-3">
                    <div class="alert alert-warning mb-0">Belum ada data stok masuk.</div>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 5%;">No</th>
                                <th>Nama Barang</th>
                                <th>Suplier</th>
                                <th>Tanggal Masuk</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                                <th class="text-center" style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stockMasuks as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $stockMasuks->firstItem() + $index }}</td>
                                    <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                                    <td>{{ $item->suplier->nama_suplier ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d-m-Y') }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('stock_masuk.destroy', $item->id) }}" method="POST" class="d-inline">
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

                <div class="p-3">
                    {{ $stockMasuks->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection