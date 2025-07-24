@extends('admin.app')

@section('content')
<div class="container mt-4" data-aos="fade-up">
    <h3 class="mb-4">📄 Daftar Dokumen yang Sudah Expired</h3>

    <div class="card shadow-sm mb-4">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Tanggal Expired</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expiredSims as $sim)
                        <tr class="clickable-row" data-href="{{ route('datasim.show', $sim->id) }}" data-aos="fade-left">
                            <td>{{ $sim->nik }}</td>
                            <td>{{ $sim->name }}</td>
                            <td class="text-center">
                                <span class="badge bg-success"><i class="bx bx-id-card me-1"></i>SIM</span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($sim->expire_date)->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                
                    @foreach($expiredSios as $sio)
                        <tr class="clickable-row" data-href="{{ route('datasio.show', $sio->id) }}" data-aos="fade-left" data-aos-delay="100">
                            <td>{{ $sio->nik }}</td>
                            <td>{{ $sio->name }}</td>
                            <td class="text-center">
                                <span class="badge bg-warning text-dark"><i class="bx bx-shield me-1"></i>SIO</span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($sio->expire_date)->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                
                    @foreach($expiredSirs as $sir)
                        <tr class="clickable-row" data-href="{{ route('datasir.show', $sir->id) }}" data-aos="fade-left" data-aos-delay="200">
                            <td>{{ $sir->nik }}</td>
                            <td>{{ $sir->nama }}</td>
                            <td class="text-center">
                                <span class="badge bg-danger"><i class="bx bx-bookmark me-1"></i>SIR</span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($sir->expire_date)->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                
                    @if($expiredSims->isEmpty() && $expiredSios->isEmpty() && $expiredSirs->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center text-muted">Tidak ada dokumen yang sudah expired.</td>
                        </tr>
                    @endif
                </tbody>
                
            </table>
        </div>
    </div>
</div>

@endsection
