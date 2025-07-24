@extends('admin.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Tambah Data Cuti</h3>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('leave.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="user_id" class="form-label">Nama Karyawan <span class="text-danger">*</span></label>
                    <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->user_id }}" {{ old('user_id') == $employee->user_id ? 'selected' : '' }}>
                                {{ $employee->user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Keterangan Cuti <span class="text-danger">*</span></label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="start_of_date" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" name="start_of_date" id="start_of_date" class="form-control @error('start_of_date') is-invalid @enderror" value="{{ old('start_of_date') }}" required>
                            @error('start_of_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="end_of_date" class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                            <input type="date" name="end_of_date" id="end_of_date" class="form-control @error('end_of_date') is-invalid @enderror" value="{{ old('end_of_date') }}" required>
                            @error('end_of_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status Cuti <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('leave.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection