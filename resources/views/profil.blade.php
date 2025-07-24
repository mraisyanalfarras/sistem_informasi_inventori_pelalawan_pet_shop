@extends('admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Detail Profil</h5>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')
                        
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Nama</label>
                                <input class="form-control" type="text" id="name" name="name" 
                                    value="{{ old('name', $user->name) }}" autofocus />
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" type="email" id="email" name="email" 
                                    value="{{ old('email', $user->email) }}" />
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                                <button type="reset" class="btn btn-outline-secondary">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <h5 class="card-header">Hapus Akun</h5>
                <div class="card-body">
                    <div class="mb-3 col-12">
                        <div class="alert alert-warning">
                            <h6 class="alert-heading fw-bold mb-1">Apakah Anda yakin ingin menghapus akun Anda?</h6>
                            <p class="mb-0">Setelah akun Anda dihapus, semua data akan hilang secara permanen. Silakan masukkan password untuk mengkonfirmasi.</p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')
                        
                        <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" />
                            @error('password', 'userDeletion')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-danger deactivate-account" 
                                onclick="return confirm('Apakah Anda yakin? Aksi ini tidak dapat dibatalkan.')">
                            Hapus Akun
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
