<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MerkController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\JenisPengadaanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\PengadaanDetailController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PenempatanMutasiController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard.main');
});


// Kategori
Route::resource('kategori',KategoriController::class );

// Merk
Route::resource('merk',MerkController::class );


// Satuan

Route::resource('satuan',SatuanController::class );

// Barang

Route::resource('barang',BarangController::class );

// Jenis-Pengadaan

Route::resource('jenis-pengadaan',JenisPengadaanController::class );

// Supplier

Route::resource('supplier',SupplierController::class );

// Pengadaan

// Route::get('/pengadaan',[PengadaanController::class, 'index']);
// Route::get('/pengadaan/read',[PengadaanController::class, 'read']);
// Route::get('/pengadaan/create',[PengadaanController::class, 'create']);
// Route::get('/pengadaan/{uuid}/edit',[PengadaanController::class, 'edit']);
// Route::post('/pengadaan/store',[PengadaanController::class, 'store']);
// Route::put('/pengadaan/{uuid}/update',[PengadaanController::class, 'update']);
// Route::get('/pengadaan/{uuid}/destroy',[PengadaanController::class, 'destroy']);
Route::resource('pengadaan',PengadaanController::class );

// Pengadaan-Detail

Route::get('/pengadaan-detail',[PengadaanDetailController::class, 'index']);
Route::get('/pengadaan-detail/read',[PengadaanDetailController::class, 'read']);
Route::get('/pengadaan-detail/create',[PengadaanDetailController::class, 'create']);
Route::get('/pengadaan-detail/{uuid}/edit',[PengadaanDetailController::class, 'edit']);
Route::post('/pengadaan-detail/store',[PengadaanDetailController::class, 'store']);
Route::put('/pengadaan-detail/{uuid}/update',[PengadaanDetailController::class, 'update']);
Route::get('/pengadaan-detail/{uuid}/destroy',[PengadaanDetailController::class, 'destroy']);

// Departemen

Route::resource('departemen',DepartemenController::class );

// Lokasi

Route::resource('lokasi',LokasiController::class );

// Karyawan

Route::get('/karyawan',[KaryawanController::class, 'index']);
Route::get('/karyawan/read',[KaryawanController::class, 'read']);
Route::get('/karyawan/create',[KaryawanController::class, 'create']);
Route::get('/karyawan/{uuid}/edit',[KaryawanController::class, 'edit']);
Route::post('/karyawan/store',[KaryawanController::class, 'store']);
Route::put('/karyawan/{uuid}/update',[KaryawanController::class, 'update']);
Route::get('/karyawan/{uuid}/destroy',[KaryawanController::class, 'destroy']);

// Peminjaman

Route::get('/peminjaman',[PeminjamanController::class, 'index']);
Route::get('/peminjaman/read',[PeminjamanController::class, 'read']);
Route::get('/peminjaman/create',[PeminjamanController::class, 'create']);
Route::get('/peminjaman/{uuid}/edit',[PeminjamanController::class, 'edit']);
Route::post('/peminjaman/store',[PeminjamanController::class, 'store']);
Route::put('/peminjaman/{uuid}/update',[PeminjamanController::class, 'update']);
Route::get('/peminjaman/{uuid}/destroy',[PeminjamanController::class, 'destroy']);

// Penempatan Mutasi

Route::get('/penempatan-mutasi',[PenempatanMutasiController::class, 'index']);
Route::get('/penempatan-mutasi/read',[PenempatanMutasiController::class, 'read']);
Route::get('/penempatan-mutasi/create',[PenempatanMutasiController::class, 'create']);
Route::get('/penempatan-mutasi/{uuid}/edit',[PenempatanMutasiController::class, 'edit']);
Route::post('/penempatan-mutasi/store',[PenempatanMutasiController::class, 'store']);
Route::put('/penempatan-mutasi/{uuid}/update',[PenempatanMutasiController::class, 'update']);
Route::get('/penempatan-mutasi/{uuid}/destroy',[PenempatanMutasiController::class, 'destroy']);





// Route::post('/kategori',[KategoriController::class , 'store']);

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
