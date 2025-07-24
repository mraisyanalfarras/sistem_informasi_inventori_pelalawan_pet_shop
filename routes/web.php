<?php

use App\Models\User;
use App\Mail\TestMail;
use App\Exports\DataSimExport;
use App\Exports\DataSioExport;
use App\Exports\DataSirExport;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DatasimController;
use App\Http\Controllers\DatasioController;
use App\Http\Controllers\DatasirController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\StokMasukController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StokKeluarController;
use App\Http\Controllers\SendPromotionController;
use App\Http\Controllers\ExpiredDocumentController;
use App\Http\Controllers\DashboardController; // pastikan ini di bagian atas
use App\Http\Controllers\StockKeluarController;
use App\Http\Controllers\StockMasukController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute untuk halaman utama - redirect ke dashboard
Route::get('/', function () {
    return redirect('/dashboard');
});

// Rute login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Rute registrasi
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Rute dashboard - perlu autentikasi
Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
})->name('dashboard')->middleware('auth');



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/dashboard/expired', [DashboardController::class, 'expiredList'])->name('expired.documents');


Route::get('/get-user-data', [UserController::class, 'getUserData'])->name('get.user.data');


// Grup rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    
    // Rute untuk manajemen pengguna
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    
   
Route::get('/api/users/search', function (Request $request) {
    $search = $request->query('q');

    return User::where('nik', 'LIKE', "%{$search}%")
        ->orWhere('name', 'LIKE', "%{$search}%")
        ->limit(10)
        ->get(['id', 'nik', 'name']);
});
    Route::get('/users/list', [UserController::class, 'list'])->name('users.list');
    Route::get('/users/list', [UserController::class, 'list']);


    // Rute untuk manajemen SDM
    Route::resource('departments', DepartmentController::class);
    Route::resource('attendance', AttendanceController::class);

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::resource('datasios', DatasioController::class);
    Route::resource('datasirs', DatasirController::class);
    Route::resource('datasims', DatasimController::class);
    Route::get('/datasims/{id}', [DataSimController::class, 'show'])->name('datasim.show');
Route::get('/datasios/{id}', [DataSioController::class, 'show'])->name('datasio.show');
Route::get('/datasirs/{id}', [DataSirController::class, 'show'])->name('datasir.show');

    Route::get('/datasims/print', [App\Http\Controllers\DataSimController::class, 'print'])->name('datasims.print');
    Route::get('/datasims/export-pdf', [DataSimController::class, 'exportPdf'])->name('datasims.exportPdf');

Route::resource('barang', BarangController::class);
Route::resource('kategori', KategoriController::class);
Route::resource('suplier', SuplierController::class);
Route::resource('customer', CustomerController::class);
Route::resource('stokmasuk', StockMasukController::class);
Route::resource('stokkeluar', StockKeluarController::class);
Route::get('/export/sim', function () {
    return Excel::download(new DataSimExport, 'data_sim.xlsx');
})->name('export.sim');

Route::get('/export/sio', function () {
    return Excel::download(new DataSioExport, 'data_sio.xlsx');
})->name('export.sio');

Route::get('/export/sir', function () {
    return Excel::download(new DataSirExport, 'data_sir.xlsx');
})->name('export.sir');

    Route::resource('send-promotions', SendPromotionController::class);
    Route::get('send-all-promotions', [EmailController::class, 'sendPromotionEmails'])->name('send.all.promotions');
});



