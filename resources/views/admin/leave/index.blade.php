@extends('admin.app')

@section('content')
<div class="container">
    @can('show leaves')
    <h3>Data Cuti</h3>

    @can('add leaves')
    <a href="{{ route('leave.create') }}" class="btn btn-primary mb-3">Tambah Cuti</a>
    @endcan

    <!-- Search Field -->
    <div class="form-group mb-3">
        <input type="text" class="form-control" placeholder="Cari..." id="search">
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Keterangan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leaves as $leave)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $leave->employee->user->name ?? 'N/A' }}</td>
                            <td>{{ $leave->description }}</td>
                            <td class="text-center">{{ $leave->start_of_date->format('Y-m-d') }}</td>
                            <td class="text-center">{{ $leave->end_of_date->format('Y-m-d') }}</td>
                            <td class="text-center">
                                @if($leave->status == 'pending')
                                    <span class="badge bg-warning">Menunggu</span>
                                @elseif($leave->status == 'approved') 
                                    <span class="badge bg-success">Disetujui</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @can('edit leaves')
                                <a href="{{ route('leave.edit', $leave->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>
                                @endcan
                                @can('delete leaves')
                                <form action="{{ route('leave.destroy', $leave->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                                        <i class="bx bx-trash"></i> Hapus
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endcan
</div>
@endsection