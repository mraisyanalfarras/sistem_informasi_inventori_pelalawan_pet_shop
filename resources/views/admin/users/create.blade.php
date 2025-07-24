@extends('admin.app')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body px-4 py-4">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                       

                     <!-- Input NIK -->
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" 
                                value="{{ old('nik') }}" required maxlength="16"
                                title="Masukkan maksimal 16 karakter (angka atau huruf)">
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="" disabled selected>Pilih Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" 
                                        {{ old('role') == $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" 
                                   value="{{ old('tanggal') }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="position" class="form-label">Posisi</label>
                            <select name="position" class="form-select @error('position') is-invalid @enderror" required>
                                <option value="" disabled selected>Pilih Posisi</option>
                                <option value="Staff" {{ old('position') == 'Staff' ? 'selected' : '' }}>Staff</option>
                                <option value="Supervisor" {{ old('position') == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
                                <option value="Manager" {{ old('position') == 'Manager' ? 'selected' : '' }}>Manager</option>
                                <option value="Director" {{ old('position') == 'Director' ? 'selected' : '' }}>Director</option>
                            </select>
                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="masuk_jadwal" class="form-label">Jadwal Masuk</label>
                            <select name="masuk_jadwal" class="form-select @error('masuk_jadwal') is-invalid @enderror" required>
                                <option value="" disabled selected>Pilih Jadwal</option>
                                <option value="Shift" {{ old('masuk_jadwal') == 'Shift' ? 'selected' : '' }}>Shift</option>
                                <option value="General" {{ old('masuk_jadwal') == 'General' ? 'selected' : '' }}>General</option>
                            </select>
                            @error('masuk_jadwal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kecelakaan" class="form-label">Riwayat Kecelakaan</label>
                            <input type="text" name="kecelakaan" class="form-control @error('kecelakaan') is-invalid @enderror" 
                                   value="{{ old('kecelakaan') }}">
                            @error('kecelakaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mulai_kerja" class="form-label">Mulai Kerja</label>
                            <input type="date" name="mulai_kerja" class="form-control @error('mulai_kerja') is-invalid @enderror" 
                                   value="{{ old('mulai_kerja') }}" required>
                            @error('mulai_kerja')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
