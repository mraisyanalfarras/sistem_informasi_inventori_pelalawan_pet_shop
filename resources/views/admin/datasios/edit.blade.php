@extends('admin.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Data SIO</h2>
    <a href="{{ route('datasios.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('datasios.update', $datasio->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Pilih Karyawan -->
                <div class="mb-3">
                    <label for="user_id" class="form-label">Nama Karyawan</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">Pilih Karyawan</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}"
                                data-nik="{{ $user->nik }}"
                                data-name="{{ $user->name }}"
                                data-position="{{ $user->position }}"
                                {{ $datasio->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} - {{ $user->nik }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Input otomatis -->
                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" name="nik" id="nik" class="form-control" value="{{ $datasio->nik }}" required>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $datasio->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="position" class="form-label">Jabatan</label>
                    <input type="text" name="position" id="position" class="form-control" value="{{ $datasio->position }}" required>
                </div>

                <!-- Form lainnya -->
                <div class="mb-3">
                    <label for="no_sio" class="form-label">No SIO</label>
                    <input type="text" name="no_sio" id="no_sio" class="form-control" value="{{ $datasio->no_sio }}" required>
                </div>

                <div class="mb-3">
                    <label for="type_sio" class="form-label">Jenis</label>
                    <input type="text" name="type_sio" id="type_sio" class="form-control" value="{{ $datasio->type_sio }}" required>
                </div>

                <div class="mb-3">
                    <label for="class" class="form-label">Class</label>
                    <select name="class" id="class" class="form-control" required>
                        <option value="active" {{ $datasio->class == 'active' ? 'selected' : '' }}>1</option>
                        <option value="expired" {{ $datasio->class == 'expired' ? 'selected' : '' }}>2</option>
                        <option value="pending" {{ $datasio->class == 'pending' ? 'selected' : '' }}>3</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="expire_date" class="form-label">Tanggal Expired</label>
                    <input type="date" name="expire_date" id="expire_date" class="form-control" value="{{ $datasio->expire_date }}" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="active" {{ $datasio->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="expired" {{ $datasio->status == 'expired' ? 'selected' : '' }}>Expired</option>
                        <option value="pending" {{ $datasio->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Lokasi</label>
                    <input type="text" name="location" id="location" class="form-control" value="{{ $datasio->location }}" required>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Upload Foto SIO (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                    @if ($datasio->foto)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $datasio->foto) }}" alt="Foto SIO" class="img-thumbnail" style="max-height: 150px;">
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Perbarui</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('user_id').addEventListener('change', function () {
        let selectedOption = this.options[this.selectedIndex];

        document.getElementById('nik').value = selectedOption.getAttribute('data-nik') || '';
        document.getElementById('name').value = selectedOption.getAttribute('data-name') || '';
        document.getElementById('position').value = selectedOption.getAttribute('data-position') || '';
    });
</script>
@endsection
