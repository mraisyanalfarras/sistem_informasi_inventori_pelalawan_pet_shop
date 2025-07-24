@extends('admin.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Kirim Promosi</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Kirim Promosi ke Pelanggan</h5>
                <div class="card-body">
                    <form action="{{ route('send-promotions.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="customer_id" class="form-label">Pilih Pelanggan</label>
                            <select class="form-select" id="customer_id" name="customer_id">
                                <option value="">Pilih Pelanggan</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }} - {{ $customer->email }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="promotion_id" class="form-label">Pilih Promosi</label>
                            <select class="form-select" id="promotion_id" name="promotion_id">
                                <option value="">Pilih Promosi</option>
                                @foreach($promotions as $promotion)
                                    <option value="{{ $promotion->id }}">{{ $promotion->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Kirim Promosi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
