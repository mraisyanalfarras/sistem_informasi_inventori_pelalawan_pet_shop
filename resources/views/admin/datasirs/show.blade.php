@extends('admin.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold">Detail Data SIR</h4>
            <a href="{{ route('datasirs.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <tbody>
                        <tr>
                            <th width="30%">NIK User</th>
                            <td>{{ $datasir->user->nik }} - {{ $datasir->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $datasir->nama }}</td>
                        </tr>
                        <tr>
                            <th>Posisi</th>
                            <td>{{ $datasir->position }}</td>
                        </tr>
                        <tr>
                            <th>No SIR</th>
                            <td>{{ $datasir->no_sir }}</td>
                        </tr>
                        <tr>
                            <th>Lokasi</th>
                            <td>{{ $datasir->location }}</td>
                        </tr>
                        <tr>
                            <th>Masa Berlaku</th>
                            <td>{{ \Carbon\Carbon::parse($datasir->expire_date)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-{{ $datasir->status == 'active' ? 'success' : ($datasir->status == 'expired' ? 'danger' : 'secondary') }}">
                                    {{ ucfirst($datasir->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Reminder</th>
                            <td>
                                @if($datasir->reminder)
                                    {{ \Carbon\Carbon::parse($datasir->reminder)->format('d M Y') }}
                                    <br><small class="text-muted">({{ \Carbon\Carbon::parse($datasir->reminder)->diffForHumans() }})</small>
                                @else
                                    <em class="text-muted">Tidak tersedia</em>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Foto SIR</th>
                            <td>
                                @if($datasir->foto)
                                    <img src="{{ asset('storage/' . $datasir->foto) }}" class="img-thumbnail" style="max-height: 200px;">
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
