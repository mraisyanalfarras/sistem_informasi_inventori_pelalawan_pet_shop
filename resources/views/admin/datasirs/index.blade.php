@extends('admin.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Data SIR</h2>
        <div>
            <div class="d-flex gap-2">
            @can('add datasirs')
            <a href="{{ route('datasirs.create') }}" class="btn btn-primary shadow-sm">Tambah SIR</a>
            @endcan

            <a href="{{ route('export.sir') }}" class="btn btn-success shadow-sm">
                <i class="fas fa-file-excel me-1"></i> Export Excel
            </a>
</div>


            {{-- <a href="{{ route('datasirs.exportPdf') }}" target="_blank" class="btn btn-danger shadow-sm">
                <i class="fa fa-file-pdf"></i> Cetak PDF
            </a> --}}
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- FILTER --}}
    <form method="GET" action="{{ route('datasirs.index') }}" class="row g-2 mb-3">
        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama / NIK" value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                <option value="revoked" {{ request('status') == 'revoked' ? 'selected' : '' }}>Revoked</option>
            </select>
        </div>
          <div class="col-md-2">
            <select name="sort_by" class="form-select">
                <option value="reminder" {{ request('sort_by') == 'reminder' ? 'selected' : '' }}>Urut Reminder</option>
                <option value="expire_date" {{ request('sort_by') == 'expire_date' ? 'selected' : '' }}>Urut Expired</option>
                {{-- <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Urut Nama</option> --}}
            </select>
        </div>
        <div class="col-md-2">
            <select name="sort_dir" class="form-select">
                <option value="asc" {{ request('sort_dir') == 'asc' ? 'selected' : '' }}>Naik (ASC)</option>
                <option value="desc" {{ request('sort_dir') == 'desc' ? 'selected' : '' }}>Turun (DESC)</option>
            </select>
        </div>
        
       
        <div class="col-md-3 d-flex">
            <button class="btn btn-secondary me-2">Filter</button>
            <a href="{{ route('datasirs.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
       
    </form>

    {{-- TABEL --}}
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <strong>Daftar Data SIR</strong>
        </div>
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Jabatan</th>
                            <th>No SIR</th>
                            <th>Lokasi</th>
                            <th>Expired</th>
                            <th>Reminder</th>
                            <th>Status</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($datasirs as $key => $sir)
                        <tr>
                            <td>{{ $datasirs->firstItem() + $key }}</td>
                            <td>{{ $sir->nama  }}</td>
                            <td>{{ $sir->nik }}</td>
                            <td>{{ $sir->position }}</td>
                            <td>{{ $sir->no_sir }}</td>
                            <td>{{ $sir->location }}</td>
                            <td>{{ \Carbon\Carbon::parse($sir->expire_date)->format('d M Y') }}</td>
                            @php
                                $expireDate = \Carbon\Carbon::parse($sir->expire_date);
                                $now = \Carbon\Carbon::now();
                                $diffInDays = $now->diffInDays($expireDate, false);

                                if ($diffInDays <= 0) {
                                    $reminderText = 'Expired';
                                    $color = 'danger';
                                } elseif ($diffInDays <= 30) {
                                    $reminderText = "Dalam $diffInDays hari";
                                    $color = 'danger';
                                } elseif ($diffInDays <= 90) {
                                    $reminderText = "Dalam " . $expireDate->diffForHumans($now, ['parts' => 2, 'short' => true]);
                                    $color = 'warning';
                                } else {
                                    $reminderText = "Masih lama";
                                    $color = 'success';
                                }
                            @endphp
                            <td>
                                <span class="badge bg-{{ $color }}">
                                    {{ $reminderText }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $statusColors = ['active' => 'success', 'expired' => 'danger', 'revoked' => 'secondary'];
                                @endphp
                                <span class="badge bg-{{ $statusColors[$sir->status] ?? 'secondary' }}">
                                    {{ strtoupper($sir->status) }}
                                </span>
                            </td>
                            <td>
                                @if($sir->foto)
                                    <img src="{{ asset('storage/' . $sir->foto) }}" alt="Foto SIR" width="50">
                                @else
                                    <span class="text-muted">Tidak Ada</span>
                                @endif
                            </td>
                            <td>
                               {{-- Tombol Aksi --}}
                                <div class="d-flex justify-content-center gap-1 flex-wrap">
                                    @can('show datasirs')
                                        <a href="{{ route('datasirs.show', $sir->id) }}" class="btn btn-sm btn-info">Lihat</a>
                                    @endcan

                                    @can('edit datasirs')
                                        <a href="{{ route('datasirs.edit', $sir->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    @endcan

                                    @can('delete datasirs')
                                        <form action="{{ route('datasirs.destroy', $sir->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>

                        
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-center">Tidak ada data SIR.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if(method_exists($datasirs, 'links'))
    <div class="d-flex justify-content-center mt-3">
        {{ $datasirs->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection
