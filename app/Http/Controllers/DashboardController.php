<?php

namespace App\Http\Controllers;

use App\Models\DataSim;
use App\Models\DataSio;
use App\Models\DataSir;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $now = now();
    $threshold = $now->copy()->addMonths(3);

    // ✅ Hitung total semua data
    $totalSim = DataSim::count();
    $totalSio = DataSio::count();
    $totalSir = DataSir::count();

    // ✅ Hitung total data expired
    $totalExpiredSim = DataSim::where('status', 'expired')->count();
    $totalExpiredSio = DataSio::where('status', 'expired')->count();
    $totalExpiredSir = DataSir::where('status', 'expired')->count();

    // ✅ Hitung total data yang akan expired dalam 3 bulan ke depan
    $totalExpiringSim = DataSim::whereBetween('expire_date', [$now, $threshold])->count();
    $totalExpiringSio = DataSio::whereBetween('expire_date', [$now, $threshold])->count();
    $totalExpiringSir = DataSir::whereBetween('expire_date', [$now, $threshold])->count();

    // ✅ Data untuk list detail (kalau kamu mau tampilkan juga)
    $simExpiringSoon = DataSim::whereBetween('expire_date', [$now, $threshold])->get();
    $sioExpiringSoon = DataSio::whereBetween('expire_date', [$now, $threshold])->get();
    $sirExpiringSoon = DataSir::whereBetween('expire_date', [$now, $threshold])->get();

    $expiredSims = DataSim::where('status', 'expired')->get();
    $expiredSios = DataSio::where('status', 'expired')->get();
    $expiredSirs = DataSir::where('status', 'expired')->get();

    $hasExpired = !$expiredSims->isEmpty() || !$expiredSios->isEmpty() || !$expiredSirs->isEmpty();
    $hasExpiringSoon = !$simExpiringSoon->isEmpty() || !$sioExpiringSoon->isEmpty() || !$sirExpiringSoon->isEmpty();

    // ✅ Kirim semua ke view
    return view('admin.dashboard.index', compact(
        'totalSim',
        'totalSio',
        'totalSir',
        'totalExpiredSim',
        'totalExpiredSio',
        'totalExpiredSir',
        'totalExpiringSim',
        'totalExpiringSio',
        'totalExpiringSir',
        'simExpiringSoon',
        'sioExpiringSoon',
        'sirExpiringSoon',
        'expiredSims',
        'expiredSios',
        'expiredSirs',
        'hasExpired',
        'hasExpiringSoon'
    ));
}

}
