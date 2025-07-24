@extends('admin.app')

@section('content')
<div class="container">
    <h3>Edit Cuti</h3>

    <form action="{{ route('leave.update', $leave->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="user_id">Nama Karyawan</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($employees as $employee)
                    <option value="{{ $employee->user_id }}" {{ $leave->user_id == $employee->user_id ? 'selected' : '' }}>
                        {{ $employee->user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Keterangan</label>
            <textarea name="description" id="description" class="form-control" required>{{ $leave->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="start_of_date">Tanggal Mulai</label>
            <input type="date" name="start_of_date" id="start_of_date" class="form-control" value="{{ $leave->start_of_date->format('Y-m-d') }}" required>
        </div>

        <div class="form-group">
            <label for="end_of_date">Tanggal Selesai</label>
            <input type="date" name="end_of_date" id="end_of_date" class="form-control" value="{{ $leave->end_of_date->format('Y-m-d') }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending" {{ $leave->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                <option value="approved" {{ $leave->status == 'approved' ? 'selected' : '' }}>Disetujui</option>
                <option value="rejected" {{ $leave->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('leave.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection