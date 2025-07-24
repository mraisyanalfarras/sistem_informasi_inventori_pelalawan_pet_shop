@extends('admin.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold">Detail Data SIM</h4>
            <a href="{{ route('datasims.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <tbody>
                        <tr>
                            <th width="30%">Nama</th>
                            <td>{{ $datasim->name }}</td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td>{{ $datasim->nik }}</td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td>{{ $datasim->position }}</td>
                        </tr>
                        <tr>
                            <th>No SIM</th>
                            <td>{{ $datasim->no_sim }}</td>
                        </tr>
                        <tr>
                            <th>Tipe SIM</th>
                            <td>{{ $datasim->type_sim }}</td>
                        </tr>
                        <tr>
                            <th>Lokasi</th>
                            <td>{{ $datasim->location }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Expired</th>
                            <td>{{ \Carbon\Carbon::parse($datasim->expire_date)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-{{ $datasim->status == 'active' ? 'success' : ($datasim->status == 'expired' ? 'danger' : 'secondary') }}">
                                    {{ ucfirst($datasim->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Reminder</th>
                            <td>
                                @if($datasim->reminder)
                                    {{ \Carbon\Carbon::parse($datasim->reminder)->format('d M Y') }}
                                    <br><small class="text-muted">({{ \Carbon\Carbon::parse($datasim->reminder)->diffForHumans() }})</small>
                                @else
                                    <em class="text-muted">Tidak tersedia</em>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Foto SIM</th>
                            <td>
                                @if($datasim->foto)
                                    <img src="{{ asset('storage/' . $datasim->foto) }}" class="img-thumbnail" style="max-height: 200px;">
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
