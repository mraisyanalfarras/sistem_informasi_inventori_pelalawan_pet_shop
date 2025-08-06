<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Suplier;
use App\Models\Customer;
use App\Models\Stock_Keluar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {$totalBarang = Barang::count();
    $totalSuplier = Suplier::count();
    $totalCustomer = Customer::count();
    $lowStockItems = Barang::with('suplier')->where('stok', '<', 10)->get();

    // Data grafik penjualan mingguan
    $weeklySales = Stock_Keluar::selectRaw('WEEK(tanggal_keluar) as week, COUNT(*) as total')
        ->whereYear('tanggal_keluar', Carbon::now()->year)
        ->groupBy('week')
        ->orderBy('week')
        ->get();

    // Data grafik penjualan bulanan
    $monthlySales = Stock_Keluar::selectRaw('MONTH(tanggal_keluar) as month, COUNT(*) as total')
        ->whereYear('tanggal_keluar', Carbon::now()->year)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Data grafik penjualan tahunan
    $yearlySales = Stock_Keluar::selectRaw('YEAR(tanggal_keluar) as year, COUNT(*) as total')
        ->groupBy('year')
        ->orderBy('year')
        ->get();

    return view('admin.dashboard.index', compact(
        'totalBarang',
        'totalSuplier',
        'totalCustomer',
        'lowStockItems',
        'weeklySales',
        'monthlySales',
        'yearlySales'
    ));
    }
}
