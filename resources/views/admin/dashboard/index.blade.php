@extends('admin.app')

@section('content')
<div class="container">

    <!-- Header -->
    <div class="card shadow-sm mb-4" style="background-color: #003366;" data-aos="fade-down">
        <div class="card-body">
            <h1 class="h3 text-white">Dashboard</h1>
            <p class="text-white">Selamat datang di Dashboard Admin. Pantau data barang, suplier, dan customer di sini.</p>
        </div>
    </div>

    <!-- Info Stok Menipis -->
    @if($lowStockItems->count())
    <div class="alert shadow-sm d-flex justify-content-between align-items-center"
         style="background-color: #ffc107; color: #000; border-left: 5px solid #d39e00; font-weight: bold;"
         data-aos="zoom-in">
        <div>
            <i class="bx bx-error-circle me-2" style="font-size: 1.5rem;"></i>
            ⚠️ Ada barang dengan stok menipis!
        </div>
        <a href="{{ route('barang.index') }}" class="btn btn-sm btn-dark fw-bold shadow-sm">
            Lihat Detail
        </a>
    </div>
    @endif

    <!-- Statistik Utama -->
    <div class="row">
        <!-- Data Barang -->
        <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="card h-100 shadow-sm" style="background-color: #e6f4ea;">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBarang }} Barang</div>
                        </div>
                        <i class="bx bx-box fa-2x text-success"></i>
                    </div>
                    <div class="mt-3 text-end">
                        <a href="{{ route('barang.index') }}" class="btn btn-sm btn-success">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Suplier -->
        <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="card h-100 shadow-sm" style="background-color: #e0f7fa;">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Suplier</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSuplier }} Suplier</div>
                        </div>
                        <i class="bx bx-user-plus fa-2x text-info"></i>
                    </div>
                    <div class="mt-3 text-end">
                        <a href="{{ route('suplier.index') }}" class="btn btn-sm btn-info text-white">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Customer -->
        <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="card h-100 shadow-sm" style="background-color: #fce4ec;">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Customer</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCustomer }} Customer</div>
                        </div>
                        <i class="bx bx-user fa-2x text-danger"></i>
                    </div>
                    <div class="mt-3 text-end">
                        <a href="{{ route('customer.index') }}" class="btn btn-sm btn-danger">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Barang Stok Rendah -->
    <div class="card shadow-sm mb-4" id="low-stock-table" data-aos="fade-up">
        <div class="card-header bg-white">
            <h6 class="m-0">Daftar Barang dengan Stok Rendah (&lt; 10)</h6>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th>Nama Barang</th>
                        <th>Kode</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Suplier</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lowStockItems as $item)
                        <tr>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->kode }}</td>
                            <td class="text-center"><span class="badge bg-danger">{{ $item->stok }}</span></td>
                            <td>{{ $item->satuan }}</td>
                            <td>{{ $item->suplier->nama_suplier ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada barang dengan stok rendah.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
<!-- Grafik Penjualan -->
<div class="card shadow-sm mb-4" data-aos="fade-up">
    <div class="card-header bg-white">
        <h6 class="m-0">Grafik Penjualan</h6>
    </div>
    <div class="card-body">
        <canvas id="weeklyChart" height="100"></canvas>
        <canvas id="monthlyChart" class="mt-4" height="100"></canvas>
        <canvas id="yearlyChart" class="mt-4" height="100"></canvas>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const weeklyLabels = {!! json_encode($weeklySales->pluck('week')) !!};
    const weeklyData = {!! json_encode($weeklySales->pluck('total')) !!};

    const monthlyLabels = {!! json_encode($monthlySales->pluck('month')->map(fn($m) => \Carbon\Carbon::create()->month($m)->format('F'))) !!};
    const monthlyData = {!! json_encode($monthlySales->pluck('total')) !!};

    const yearlyLabels = {!! json_encode($yearlySales->pluck('year')) !!};
    const yearlyData = {!! json_encode($yearlySales->pluck('total')) !!};

    const renderChart = (id, labels, data, label) => {
        new Chart(document.getElementById(id), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    backgroundColor: '#003366',
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }
            }
        });
    }

    renderChart('weeklyChart', weeklyLabels, weeklyData, 'Penjualan per Minggu');
    renderChart('monthlyChart', monthlyLabels, monthlyData, 'Penjualan per Bulan');
    renderChart('yearlyChart', yearlyLabels, yearlyData, 'Penjualan per Tahun');
</script>
</div>
@endsection
