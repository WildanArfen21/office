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

// Kategori
Route::get('/kategori',[KategoriController::class, 'index']);
Route::get('/kategori/read',[KategoriController::class, 'read']);
Route::get('/kategori/create',[KategoriController::class, 'create']);
Route::get('/kategori/{uuid}/edit',[KategoriController::class, 'edit']);
Route::post('/kategori/store',[KategoriController::class, 'store']);
Route::put('/kategori/{uuid}/update',[KategoriController::class, 'update']);
Route::get('/kategori/{uuid}/destroy',[KategoriController::class, 'destroy']);

// Merk

Route::get('/merk',[MerkController::class, 'index']);
Route::get('/merk/read',[MerkController::class, 'read']);
Route::get('/merk/create',[MerkController::class, 'create']);
Route::get('/merk/{uuid}/edit',[MerkController::class, 'edit']);
Route::post('/merk/store',[MerkController::class, 'store']);
Route::put('/merk/{uuid}/update',[MerkController::class, 'update']);
Route::get('/merk/{uuid}/destroy',[MerkController::class, 'destroy']);

// Satuan

Route::get('/satuan',[SatuanController::class, 'index']);
Route::get('/satuan/read',[SatuanController::class, 'read']);
Route::get('/satuan/create',[SatuanController::class, 'create']);
Route::get('/satuan/{uuid}/edit',[SatuanController::class, 'edit']);
Route::post('/satuan/store',[SatuanController::class, 'store']);
Route::put('/satuan/{uuid}/update',[SatuanController::class, 'update']);
Route::get('/satuan/{uuid}/destroy',[SatuanController::class, 'destroy']);

// Barang

Route::get('/barang',[BarangController::class, 'index']);
Route::get('/barang/read',[BarangController::class, 'read']);
Route::get('/barang/create',[BarangController::class, 'create']);
Route::get('/barang/{uuid}/edit',[BarangController::class, 'edit']);
Route::post('/barang/store',[BarangController::class, 'store']);
Route::put('/barang/{uuid}/update',[BarangController::class, 'update']);
Route::get('/barang/{uuid}/destroy',[BarangController::class, 'destroy']);

// Jenis-Pengadaan

Route::get('/jenis-pengadaan',[JenisPengadaanController::class, 'index']);
Route::get('/jenis-pengadaan/read',[JenisPengadaanController::class, 'read']);
Route::get('/jenis-pengadaan/create',[JenisPengadaanController::class, 'create']);
Route::get('/jenis-pengadaan/{uuid}/edit',[JenisPengadaanController::class, 'edit']);
Route::post('/jenis-pengadaan/store',[JenisPengadaanController::class, 'store']);
Route::put('/jenis-pengadaan/{uuid}/update',[JenisPengadaanController::class, 'update']);
Route::get('/jenis-pengadaan/{uuid}/destroy',[JenisPengadaanController::class, 'destroy']);

// Supplier

Route::get('/supplier',[SupplierController::class, 'index']);
Route::get('/supplier/read',[SupplierController::class, 'read']);
Route::get('/supplier/create',[SupplierController::class, 'create']);
Route::get('/supplier/{uuid}/edit',[SupplierController::class, 'edit']);
Route::post('/supplier/store',[SupplierController::class, 'store']);
Route::put('/supplier/{uuid}/update',[SupplierController::class, 'update']);
Route::get('/supplier/{uuid}/destroy',[SupplierController::class, 'destroy']);

// Pengadaan

Route::get('/pengadaan',[PengadaanController::class, 'index']);
Route::get('/pengadaan/read',[PengadaanController::class, 'read']);
Route::get('/pengadaan/create',[PengadaanController::class, 'create']);
Route::get('/pengadaan/{uuid}/edit',[PengadaanController::class, 'edit']);
Route::post('/pengadaan/store',[PengadaanController::class, 'store']);
Route::put('/pengadaan/{uuid}/update',[PengadaanController::class, 'update']);
Route::get('/pengadaan/{uuid}/destroy',[PengadaanController::class, 'destroy']);

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
