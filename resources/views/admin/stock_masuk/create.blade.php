@extends('admin.app')

@section('content')
<div class="container mt-4">
    <div class="bg-white p-4 rounded shadow-sm">
        <h4 class="mb-4">Form Tambah Stok Masuk</h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('stock_masuk.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="suplier_id" class="form-label">Suplier</label>
                    <select name="suplier_id" class="form-select" required>
                        <option value="">-- Pilih Suplier --</option>
                        @foreach($supliers as $suplier)
                            <option value="{{ $suplier->id }}">{{ $suplier->nama_suplier }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
            </div>

            <hr>

            <label class="form-label">Detail Barang</label>
            <div id="form-barang">
                <div class="row mb-2 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label">Barang</label>
                        <select name="barang_id[]" class="form-select" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="jumlah[]" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Keterangan</label>
                        <input type="text" name="keterangan[]" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm mt-4 remove-row">Hapus</button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-outline-secondary btn-sm mb-3" id="add-row">+ Tambah Barang</button>

            <div class="text-end">
                <button type="submit" class="btn btn-success">Simpan Semua</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('add-row').addEventListener('click', function () {
        const formBarang = document.getElementById('form-barang');
        const newRow = formBarang.firstElementChild.cloneNode(true);

        newRow.querySelectorAll('input').forEach(input => input.value = '');
        newRow.querySelector('select').selectedIndex = 0;
        formBarang.appendChild(newRow);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-row')) {
            const row = e.target.closest('.row');
            if (document.querySelectorAll('#form-barang .row').length > 1) {
                row.remove();
            }
        }
    });
</script>
@endsection
