@extends('admin.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg">
        <div class="card-header bg-gradient-primary text-white">
            <h3 class="mb-0">Edit Role: {{ $role->name }}</h3>
        </div>
        <div class="card-body">
            <!-- Pesan Error -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulir -->
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Input Nama Role -->
                <div class="mb-4">
                    <label for="name" class="form-label fw-bold">Nama Role</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}" class="form-control rounded-pill" placeholder="Masukkan nama role" required>
                </div>

                <!-- Checkbox Permissions -->
                <div class="mb-4">
                    <label for="permissions" class="form-label fw-bold">Permissions</label>
                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[{{ $permission->id }}]" 
                                           value="{{ $permission->name }}" 
                                           id="permission_{{ $permission->id }}"
                                           {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                                        {{ ucfirst($permission->name) }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
