<?php

use App\Http\Controllers\AlatbarangController;
use App\Http\Controllers\AlatbarangPinjamController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RentLogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PublicController::class, 'index']);

Route::middleware('only_guest')->group(function()
{
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticating']);
    Route::get('register', [AuthController::class, 'register']);
    Route::post('register', [AuthController::class, 'registerProcess']);
});


Route::middleware('auth')->group(function() {
    Route::get('logout', [AuthController::class, 'logout']);

    Route::get('alatbarangs', [AlatbarangController::class, 'index']);

    Route::get('alatbarang-pinjam{id}', [AlatbarangPinjamController::class, 'index']);
    Route::post('alatbarang-pinjam', [AlatbarangPinjamController::class, 'pinjam']);

});

Route::middleware('auth', 'only_admin')->group(function() {
    Route::get('dashboard', [DashboardController::class, 'index']);


    Route::get('kategori', [CategoryController::class, 'index']);
    Route::get('kategori/add', [CategoryController::class, 'create']);
    Route::post('kategori', [CategoryController::class, 'store']);
    Route::match(['get', 'put'], 'kategori/edit{slug}', [CategoryController::class, 'edit']);
    Route::match(['get', 'delete'], 'kategori/delete{slug}', [CategoryController::class, 'destroy']);

    Route::get('pengguna', [UserController::class, 'index']);
    Route::get('pengguna/aktifkan{slug}', [UserController::class, 'aktifkan']);
    Route::get('pengguna/nonaktifkan{slug}', [UserController::class, 'nonaktifkan']);
    Route::match(['get', 'post'], 'pengguna/edit{slug}', [UserController::class, 'edit']);
    Route::match(['get', 'delete'], 'pengguna/delete{slug}', [UserController::class, 'destroy']);

    Route::get('alatbarangs/add', [AlatbarangController::class, 'create']);
    Route::post('alatbarangs', [AlatbarangController::class, 'store']);
    Route::match(['get', 'post'], 'alatbarangs/edit{slug}', [AlatbarangController::class, 'edit']);
    Route::match(['get', 'delete'], 'alatbarangs/delete{slug}', [AlatbarangController::class, 'destroy']);

    Route::get('rentlogs', [RentLogController::class, 'index']);
    Route::post('rentlogs', [RentLogController::class, 'kembali']);

    Route::get('cetak-pdf', [PdfController::class, 'cetakPdf']);
});
