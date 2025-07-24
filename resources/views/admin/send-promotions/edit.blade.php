@extends('admin.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Edit Pengiriman Promosi</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Edit Pengiriman Promosi</h5>
                <div class="card-body">
                    <form action="{{ route('send-promotions.update', $sendPromotion->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="customer_id" class="form-label">Pilih Pelanggan</label>
                            <select class="form-select" id="customer_id" name="customer_id">
                                <option value="">Pilih Pelanggan</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ $sendPromotion->customer_id == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }} - {{ $customer->email }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="promotion_id" class="form-label">Pilih Promosi</label>
                            <select class="form-select" id="promotion_id" name="promotion_id">
                                <option value="">Pilih Promosi</option>
                                @foreach($promotions as $promotion)
                                    <option value="{{ $promotion->id }}" {{ $sendPromotion->promotion_id == $promotion->id ? 'selected' : '' }}>
                                        {{ $promotion->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="sent" {{ $sendPromotion->status == 'sent' ? 'selected' : '' }}>Terkirim</option>
                                <option value="failed" {{ $sendPromotion->status == 'failed' ? 'selected' : '' }}>Gagal</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data pengiriman promosi ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('send-promotions.destroy', $sendPromotion->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
