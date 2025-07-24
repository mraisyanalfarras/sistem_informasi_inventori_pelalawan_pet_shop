@extends('admin.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded-3 border">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Edit Pengguna</h5>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-control" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" 
                                {{ $user->getRoleNames()->isNotEmpty() && $user->getRoleNames()[0] == $role->name ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $user->tanggal) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Posisi</label>
                    <input type="text" name="position" class="form-control" value="{{ old('position', $user->position) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jadwal Masuk</label>
                    <select name="masuk_jadwal" class="form-control">
                        <option value="Shift" {{ old('masuk_jadwal', $user->masuk_jadwal) == 'Shift' ? 'selected' : '' }}>Shift</option>
                        <option value="General" {{ old('masuk_jadwal', $user->masuk_jadwal) == 'General' ? 'selected' : '' }}>General</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kecelakaan</label>
                    <input type="text" name="kecelakaan" class="form-control" value="{{ old('kecelakaan', $user->kecelakaan) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Mulai Kerja</label>
                    <input type="date" name="mulai_kerja" class="form-control" value="{{ old('mulai_kerja', $user->mulai_kerja) }}">
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
