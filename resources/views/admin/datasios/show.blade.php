@extends('admin.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold">Detail Data SIO</h4>
            <a href="{{ route('datasios.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <tbody>
                        <tr>
                            <th width="30%">NIK User</th>
                            <td>{{ $datasio->user->nik }} - {{ $datasio->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $datasio->name }}</td>
                        </tr>
                        <tr>
                            <th>Posisi</th>
                            <td>{{ $datasio->position }}</td>
                        </tr>
                        <tr>
                            <th>No SIO</th>
                            <td>{{ $datasio->no_sio }}</td>
                        </tr>
                        <tr>
                            <th>Tipe</th>
                            <td>{{ $datasio->type_sio }}</td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>{{ $datasio->class }}</td>
                        </tr>
                        <tr>
                            <th>Lokasi</th>
                            <td>{{ $datasio->location }}</td>
                        </tr>
                        <tr>
                            <th>Masa Berlaku</th>
                            <td>{{ \Carbon\Carbon::parse($datasio->expire_date)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-{{ $datasio->status == 'active' ? 'success' : ($datasio->status == 'expired' ? 'danger' : 'secondary') }}">
                                    {{ ucfirst($datasio->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Reminder</th>
                            <td>
                                @if($datasio->reminder)
                                    {{ \Carbon\Carbon::parse($datasio->reminder)->format('d M Y') }}
                                    <br><small class="text-muted">({{ \Carbon\Carbon::parse($datasio->reminder)->diffForHumans() }})</small>
                                @else
                                    <em class="text-muted">Tidak tersedia</em>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Foto SIO</th>
                            <td>
                                @if($datasio->foto)
                                    <img src="{{ asset('storage/' . $datasio->foto) }}" class="img-thumbnail" style="max-height: 200px;">
                                @else
                                    <span class="text-muted">Tidak ada foto</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
