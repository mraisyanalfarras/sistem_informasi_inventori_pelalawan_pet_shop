@extends('admin.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Data SIR</h2>
    <a href="{{ route('datasirs.index') }}" class="btn btn-secondary mb-3">Kembali</a>

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
            <form action="{{ route('datasirs.update', $datasir->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="user_id" class="form-label">Nama Karyawan</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">Pilih Karyawan</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}"
                                data-nik="{{ $user->nik }}"
                                data-nama="{{ $user->name }}"
                                data-position="{{ $user->position }}"
                                {{ $datasir->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} - {{ $user->nik }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" name="nik" id="nik" class="form-control" value="{{ $datasir->nik }}" required>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $datasir->nama }}" required>
                </div>

                <div class="mb-3">
                    <label for="position" class="form-label">Jabatan</label>
                    <input type="text" name="position" id="position" class="form-control" value="{{ $datasir->position }}" required>
                </div>

                <div class="mb-3">
                    <label for="no_sir" class="form-label">No SIR</label>
                    <input type="text" name="no_sir" id="no_sir" class="form-control" value="{{ $datasir->no_sir }}" required>
                </div>

                <div class="mb-3">
                    <label for="expire_date" class="form-label">Tanggal Expired</label>
                    <input type="date" name="expire_date" id="expire_date" class="form-control" value="{{ $datasir->expire_date }}" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="active" {{ $datasir->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="expired" {{ $datasir->status == 'expired' ? 'selected' : '' }}>Expired</option>
                        <option value="revoked" {{ $datasir->status == 'revoked' ? 'selected' : '' }}>Revoked</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Lokasi</label>
                    <input type="text" name="location" id="location" class="form-control" value="{{ $datasir->location }}" required>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Upload Foto SIM (Opsional)</label><br>
                    @if ($datasir->foto)
                        <img src="{{ asset('storage/' . $datasir->foto) }}" alt="Foto" width="100" class="mb-2">
                    @endif
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('user_id').addEventListener('change', function() {
        let selectedOption = this.options[this.selectedIndex];

        document.getElementById('nik').value = selectedOption.getAttribute('data-nik') || '';
        document.getElementById('nama').value = selectedOption.getAttribute('data-nama') || '';
        document.getElementById('position').value = selectedOption.getAttribute('data-position') || '';
    });
</script>
@endsection
