@extends('admin.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Data SIM</h2>
    <a href="{{ route('datasims.index') }}" class="btn btn-secondary mb-3">Kembali</a>

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
            <form action="{{ route('datasims.update', $datasim->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="user_id" class="form-label">Nama Karyawan</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">Pilih Karyawan</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}"
                                data-nik="{{ $user->nik }}"
                                data-name="{{ $user->name }}"
                                data-position="{{ $user->position }}"
                                {{ $user->id == $datasim->user_id ? 'selected' : '' }}>
                                {{ $user->name }} - {{ $user->nik }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" name="nik" id="nik" class="form-control" value="{{ $datasim->nik }}" readonly required>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $datasim->name }}" readonly required>
                </div>

                <div class="mb-3">
                    <label for="position" class="form-label">Jabatan</label>
                    <input type="text" name="position" id="position" class="form-control" value="{{ $datasim->position }}" readonly required>
                </div>

                <div class="mb-3">
                    <label for="no_sim" class="form-label">No SIM</label>
                    <input type="text" name="no_sim" id="no_sim" class="form-control" value="{{ $datasim->no_sim }}" required>
                </div>

                <div class="mb-3">
                    <label for="type_sim" class="form-label">Tipe SIM</label>
                    <input type="text" name="type_sim" id="type_sim" class="form-control" value="{{ $datasim->type_sim }}" required>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Lokasi</label>
                    <input type="text" name="location" id="location" class="form-control" value="{{ $datasim->location }}" required>
                </div>

                <div class="mb-3">
                    <label for="expire_date" class="form-label">Tanggal Expired</label>
                    <input type="date" name="expire_date" id="expire_date" class="form-control" value="{{ $datasim->expire_date }}" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="active" {{ $datasim->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="expired" {{ $datasim->status == 'expired' ? 'selected' : '' }}>Expired</option>
                        <option value="revoked" {{ $datasim->status == 'revoked' ? 'selected' : '' }}>Revoked</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto SIM</label><br>
                    @if($datasim->foto)
                        <img src="{{ asset('storage/' . $datasim->foto) }}" width="100" class="mb-2"><br>
                    @endif
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Perbarui</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('user_id').addEventListener('change', function () {
        let selected = this.options[this.selectedIndex];
        document.getElementById('nik').value = selected.getAttribute('data-nik') || '';
        document.getElementById('name').value = selected.getAttribute('data-name') || '';
        document.getElementById('position').value = selected.getAttribute('data-position') || '';
    });
</script>
@endsection
