<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KartuController;
use App\Http\Controllers\PulsaController;
use App\Http\Controllers\BillerController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BillerPulsaController;
use App\Http\Controllers\DealerPulsaController;
use App\Http\Controllers\SupplierPulsaController;
use App\Http\Controllers\BillerKartuPerdanaController;
use App\Http\Controllers\DealerKartuPerdanaController;
use App\Http\Controllers\ApprovedDealerPulsaController;
use App\Http\Controllers\PembelianBillerPulsaController;
use App\Http\Controllers\PembelianDealerPulsaController;
use App\Http\Controllers\PenjualanBillerPulsaController;
use App\Http\Controllers\PenjualanDealerPulsaController;
use App\Http\Controllers\SupplierKartuPerdanaController;
use App\Http\Controllers\ApprovedSupplierPulsaController;
use App\Http\Controllers\PenjualanSupplierPulsaController;
use App\Http\Controllers\ApprovedDealerKartuPerdanaController;
use App\Http\Controllers\PembelianBillerKartuPerdanaController;
use App\Http\Controllers\PembelianDealerKartuPerdanaController;
use App\Http\Controllers\PenjualanBillerKartuPerdanaController;
use App\Http\Controllers\PenjualanDealerKartuPerdanaController;
use App\Http\Controllers\ApprovedSupplierKartuPerdanaController;
use App\Http\Controllers\PenjualanSupplierKartuPerdanaController;

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

// All role
Route::group(['middleware' => 'guest'], function(){
    
    // Auth
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login-process', [AuthController::class, 'loginProcess']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register-process', [AuthController::class, 'registerProcess']);
    
});

// All role
Route::group(['middleware' => 'auth'], function(){
    
    // Auth
    Route::get('/logout', [AuthController::class, 'logout']);

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::put('/update-profile', [DashboardController::class, 'updateProfile']);

    // User
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/add', [UserController::class, 'add']);
    Route::post('/user/create', [UserController::class, 'create']);
    Route::get('/user/{id}/edit', [UserController::class, 'edit']);
    Route::put('/user/{id}/update', [UserController::class, 'update']);
    Route::put('/user/{id}/delete', [UserController::class, 'delete']);
    Route::get('/user/{id}/status', [UserController::class, 'status']);
    Route::put('/user/{id}/status-update', [UserController::class, 'statusUpdate']);

    // Pulsa
    Route::get('/pulsa', [PulsaController::class, 'index']);
    Route::get('/pulsa/add', [PulsaController::class, 'add']);
    Route::post('/pulsa/create', [PulsaController::class, 'create']);
    Route::get('/pulsa/{id}/edit', [PulsaController::class, 'edit']);
    Route::put('/pulsa/{id}/update', [PulsaController::class, 'update']);
    Route::put('/pulsa/{id}/delete', [PulsaController::class, 'delete']);

    // Kartu
    Route::get('/kartu', [KartuController::class, 'index']);
    Route::get('/kartu/add', [KartuController::class, 'add']);
    Route::post('/kartu/create', [KartuController::class, 'create']);
    Route::get('/kartu/{id}/edit', [KartuController::class, 'edit']);
    Route::put('/kartu/{id}/update', [KartuController::class, 'update']);
    Route::put('/kartu/{id}/delete', [KartuController::class, 'delete']);
    
    // Supplier
    Route::get('/supplier', [SupplierController::class, 'index']);
    Route::get('/supplier/add', [SupplierController::class, 'add']);
    Route::post('/supplier/create', [SupplierController::class, 'create']);
    Route::get('/supplier/{id}/edit', [SupplierController::class, 'edit']);
    Route::put('/supplier/{id}/update', [SupplierController::class, 'update']);
    Route::put('/supplier/{id}/delete', [SupplierController::class, 'delete']);
    
    // Supplier Pulsa
    Route::get('/supplier-pulsa', [SupplierPulsaController::class, 'index']);
    Route::get('/supplier-pulsa/add', [SupplierPulsaController::class, 'add']);
    Route::post('/supplier-pulsa/create', [SupplierPulsaController::class, 'create']);
    Route::get('/supplier-pulsa/{id}/edit', [SupplierPulsaController::class, 'edit']);
    Route::put('/supplier-pulsa/{id}/update', [SupplierPulsaController::class, 'update']);
    Route::put('/supplier-pulsa/{id}/delete', [SupplierPulsaController::class, 'delete']);
    
    // Supplier Kartu Perdana
    Route::get('/supplier-kartu-perdana', [SupplierKartuPerdanaController::class, 'index']);
    Route::get('/supplier-kartu-perdana/add', [SupplierKartuPerdanaController::class, 'add']);
    Route::post('/supplier-kartu-perdana/create', [SupplierKartuPerdanaController::class, 'create']);
    Route::get('/supplier-kartu-perdana/{id}/edit', [SupplierKartuPerdanaController::class, 'edit']);
    Route::put('/supplier-kartu-perdana/{id}/update', [SupplierKartuPerdanaController::class, 'update']);
    Route::put('/supplier-kartu-perdana/{id}/delete', [SupplierKartuPerdanaController::class, 'delete']);
    
    // Penjualan Supplier Pulsa
    Route::get('/penjualan-supplier-pulsa', [PenjualanSupplierPulsaController::class, 'index']);
    Route::get('/penjualan-supplier-pulsa/filter-date', [PenjualanSupplierPulsaController::class, 'filterDate']);
    Route::get('/penjualan-supplier-pulsa/add', [PenjualanSupplierPulsaController::class, 'add']);
    Route::post('/penjualan-supplier-pulsa/create', [PenjualanSupplierPulsaController::class, 'create']);
    Route::get('/penjualan-supplier-pulsa/export-pdf', [PenjualanSupplierPulsaController::class, 'exportPdf']);
    Route::get('/penjualan-supplier-pulsa/{id}/edit', [PenjualanSupplierPulsaController::class, 'edit']);
    Route::put('/penjualan-supplier-pulsa/{id}/update', [PenjualanSupplierPulsaController::class, 'update']);
    Route::put('/penjualan-supplier-pulsa/{id}/delete', [PenjualanSupplierPulsaController::class, 'delete']);
    
    // Penjualan Supplier Kartu Perdana
    Route::get('/penjualan-supplier-kartu-perdana', [PenjualanSupplierKartuPerdanaController::class, 'index']);
    Route::get('/penjualan-supplier-kartu-perdana/filter-date', [PenjualanSupplierKartuPerdanaController::class, 'filterDate']);
    Route::get('/penjualan-supplier-kartu-perdana/add', [PenjualanSupplierKartuPerdanaController::class, 'add']);
    Route::post('/penjualan-supplier-kartu-perdana/create', [PenjualanSupplierKartuPerdanaController::class, 'create']);
    Route::get('/penjualan-supplier-kartu-perdana/export-pdf', [PenjualanSupplierKartuPerdanaController::class, 'exportPdf']);
    Route::get('/penjualan-supplier-kartu-perdana/{id}/edit', [PenjualanSupplierKartuPerdanaController::class, 'edit']);
    Route::put('/penjualan-supplier-kartu-perdana/{id}/update', [PenjualanSupplierKartuPerdanaController::class, 'update']);
    Route::put('/penjualan-supplier-kartu-perdana/{id}/delete', [PenjualanSupplierKartuPerdanaController::class, 'delete']);
    
    // Approved Supplier Pulsa
    Route::get('/approved-supplier-pulsa', [ApprovedSupplierPulsaController::class, 'index']);
    Route::get('/approved-supplier-pulsa/filter-date', [ApprovedSupplierPulsaController::class, 'filterDate']);
    Route::get('/approved-supplier-pulsa/{id}/approved', [ApprovedSupplierPulsaController::class, 'approved']);
    
    // Approved Supplier Kartu Perdana
    Route::get('/approved-supplier-kartu-perdana', [ApprovedSupplierKartuPerdanaController::class, 'index']);
    Route::get('/approved-supplier-kartu-perdana/filter-date', [ApprovedSupplierKartuPerdanaController::class, 'filterDate']);
    Route::get('/approved-supplier-kartu-perdana/{id}/approved', [ApprovedSupplierKartuPerdanaController::class, 'approved']);

    // Dealer
    Route::get('/dealer', [DealerController::class, 'index']);
    Route::get('/dealer/add', [DealerController::class, 'add']);
    Route::post('/dealer/create', [DealerController::class, 'create']);
    Route::get('/dealer/{id}/edit', [DealerController::class, 'edit']);
    Route::put('/dealer/{id}/update', [DealerController::class, 'update']);
    Route::put('/dealer/{id}/delete', [DealerController::class, 'delete']);

    // Dealer Pulsa
    Route::get('/dealer-pulsa', [DealerPulsaController::class, 'index']);
    Route::get('/dealer-pulsa/add', [DealerPulsaController::class, 'add']);
    Route::post('/dealer-pulsa/create', [DealerPulsaController::class, 'create']);
    Route::get('/dealer-pulsa/{id}/tambah-saldo', [DealerPulsaController::class, 'tambahSaldo']);
    Route::post('/dealer-pulsa/{id}/create-tambah-saldo', [DealerPulsaController::class, 'createTambahSaldo']);
    Route::get('/dealer-pulsa/{id}/edit', [DealerPulsaController::class, 'edit']);
    Route::put('/dealer-pulsa/{id}/update', [DealerPulsaController::class, 'update']);
    Route::put('/dealer-pulsa/{id}/delete', [DealerPulsaController::class, 'delete']);
    
    // Dealer Kartu Perdana
    Route::get('/dealer-kartu-perdana', [DealerKartuPerdanaController::class, 'index']);
    Route::get('/dealer-kartu-perdana/add', [DealerKartuPerdanaController::class, 'add']);
    Route::post('/dealer-kartu-perdana/create', [DealerKartuPerdanaController::class, 'create']);
    Route::get('/dealer-kartu-perdana/{id}/tambah-stok', [DealerKartuPerdanaController::class, 'tambahStok']);
    Route::post('/dealer-kartu-perdana/{id}/create-tambah-stok', [DealerKartuPerdanaController::class, 'createTambahStok']);
    Route::get('/dealer-kartu-perdana/{id}/edit', [DealerKartuPerdanaController::class, 'edit']);
    Route::put('/dealer-kartu-perdana/{id}/update', [DealerKartuPerdanaController::class, 'update']);
    Route::put('/dealer-kartu-perdana/{id}/delete', [DealerKartuPerdanaController::class, 'delete']);

    // Pembelian Dealer Pulsa
    Route::get('/pembelian-dealer-pulsa', [PembelianDealerPulsaController::class, 'index']);
    Route::get('/pembelian-dealer-pulsa/filter-date', [PembelianDealerPulsaController::class, 'filterDate']);
    Route::get('/pembelian-dealer-pulsa/add', [PembelianDealerPulsaController::class, 'add']);
    Route::post('/pembelian-dealer-pulsa/create', [PembelianDealerPulsaController::class, 'create']);
    Route::get('/pembelian-dealer-pulsa/export-pdf', [PembelianDealerPulsaController::class, 'exportPdf']);
    Route::get('/pembelian-dealer-pulsa/{id}/edit', [PembelianDealerPulsaController::class, 'edit']);
    Route::put('/pembelian-dealer-pulsa/{id}/update', [PembelianDealerPulsaController::class, 'update']);
    Route::put('/pembelian-dealer-pulsa/{id}/delete', [PembelianDealerPulsaController::class, 'delete']);
    
    // Pembelian Dealer Kartu Perdana
    Route::get('/pembelian-dealer-kartu-perdana', [PembelianDealerKartuPerdanaController::class, 'index']);
    Route::get('/pembelian-dealer-kartu-perdana/filter-date', [PembelianDealerKartuPerdanaController::class, 'filterDate']);
    Route::get('/pembelian-dealer-kartu-perdana/add', [PembelianDealerKartuPerdanaController::class, 'add']);
    Route::post('/pembelian-dealer-kartu-perdana/create', [PembelianDealerKartuPerdanaController::class, 'create']);
    Route::get('/pembelian-dealer-kartu-perdana/export-pdf', [PembelianDealerKartuPerdanaController::class, 'exportPdf']);
    Route::get('/pembelian-dealer-kartu-perdana/{id}/edit', [PembelianDealerKartuPerdanaController::class, 'edit']);
    Route::put('/pembelian-dealer-kartu-perdana/{id}/update', [PembelianDealerKartuPerdanaController::class, 'update']);
    Route::put('/pembelian-dealer-kartu-perdana/{id}/delete', [PembelianDealerKartuPerdanaController::class, 'delete']);
    
    // Penjualan Dealer Pulsa
    Route::get('/penjualan-dealer-pulsa', [PenjualanDealerPulsaController::class, 'index']);
    Route::get('/penjualan-dealer-pulsa/filter-date', [PenjualanDealerPulsaController::class, 'filterDate']);
    Route::get('/penjualan-dealer-pulsa/add', [PenjualanDealerPulsaController::class, 'add']);
    Route::post('/penjualan-dealer-pulsa/create', [PenjualanDealerPulsaController::class, 'create']);
    Route::get('/penjualan-dealer-pulsa/export-pdf', [PenjualanDealerPulsaController::class, 'exportPdf']);
    Route::get('/penjualan-dealer-pulsa/{id}/edit', [PenjualanDealerPulsaController::class, 'edit']);
    Route::put('/penjualan-dealer-pulsa/{id}/update', [PenjualanDealerPulsaController::class, 'update']);
    Route::put('/penjualan-dealer-pulsa/{id}/delete', [PenjualanDealerPulsaController::class, 'delete']);
    
    // Penjualan Dealer Kartu Perdana
    Route::get('/penjualan-dealer-kartu-perdana', [PenjualanDealerKartuPerdanaController::class, 'index']);
    Route::get('/penjualan-dealer-kartu-perdana/filter-date', [PenjualanDealerKartuPerdanaController::class, 'filterDate']);
    Route::get('/penjualan-dealer-kartu-perdana/add', [PenjualanDealerKartuPerdanaController::class, 'add']);
    Route::post('/penjualan-dealer-kartu-perdana/create', [PenjualanDealerKartuPerdanaController::class, 'create']);
    Route::get('/penjualan-dealer-kartu-perdana/export-pdf', [PenjualanDealerKartuPerdanaController::class, 'exportPdf']);
    Route::get('/penjualan-dealer-kartu-perdana/{id}/edit', [PenjualanDealerKartuPerdanaController::class, 'edit']);
    Route::put('/penjualan-dealer-kartu-perdana/{id}/update', [PenjualanDealerKartuPerdanaController::class, 'update']);
    Route::put('/penjualan-dealer-kartu-perdana/{id}/delete', [PenjualanDealerKartuPerdanaController::class, 'delete']);

    // Approved Dealer Pulsa
    Route::get('/approved-dealer-pulsa', [ApprovedDealerPulsaController::class, 'index']);
    Route::get('/approved-dealer-pulsa/filter-date', [ApprovedDealerPulsaController::class, 'filterDate']);
    Route::get('/approved-dealer-pulsa/{id}/approved', [ApprovedDealerPulsaController::class, 'approved']);
    
    // Approved Dealer Kartu Perdana
    Route::get('/approved-dealer-kartu-perdana', [ApprovedDealerKartuPerdanaController::class, 'index']);
    Route::get('/approved-dealer-kartu-perdana/filter-date', [ApprovedDealerKartuPerdanaController::class, 'filterDate']);
    Route::get('/approved-dealer-kartu-perdana/{id}/approved', [ApprovedDealerKartuPerdanaController::class, 'approved']);

    // Biller
    Route::get('/biller', [BillerController::class, 'index']);
    Route::get('/biller/add', [BillerController::class, 'add']);
    Route::post('/biller/create', [BillerController::class, 'create']);
    Route::get('/biller/{id}/edit', [BillerController::class, 'edit']);
    Route::put('/biller/{id}/update', [BillerController::class, 'update']);
    Route::put('/biller/{id}/delete', [BillerController::class, 'delete']);

    // Biller Pulsa
    Route::get('/biller-pulsa', [BillerPulsaController::class, 'index']);
    Route::get('/biller-pulsa/add', [BillerPulsaController::class, 'add']);
    Route::post('/biller-pulsa/create', [BillerPulsaController::class, 'create']);
    Route::get('/biller-pulsa/{id}/tambah-saldo', [BillerPulsaController::class, 'tambahSaldo']);
    Route::post('/biller-pulsa/{id}/create-tambah-saldo', [BillerPulsaController::class, 'createTambahSaldo']);
    Route::get('/biller-pulsa/{id}/edit', [BillerPulsaController::class, 'edit']);
    Route::put('/biller-pulsa/{id}/update', [BillerPulsaController::class, 'update']);
    Route::put('/biller-pulsa/{id}/delete', [BillerPulsaController::class, 'delete']);
    
    // Biller Kartu Perdana
    Route::get('/biller-kartu-perdana', [BillerKartuPerdanaController::class, 'index']);
    Route::get('/biller-kartu-perdana/add', [BillerKartuPerdanaController::class, 'add']);
    Route::post('/biller-kartu-perdana/create', [BillerKartuPerdanaController::class, 'create']);
    Route::get('/biller-kartu-perdana/{id}/tambah-stok', [BillerKartuPerdanaController::class, 'tambahStok']);
    Route::post('/biller-kartu-perdana/{id}/create-tambah-stok', [BillerKartuPerdanaController::class, 'createTambahStok']);
    Route::get('/biller-kartu-perdana/{id}/edit', [BillerKartuPerdanaController::class, 'edit']);
    Route::put('/biller-kartu-perdana/{id}/update', [BillerKartuPerdanaController::class, 'update']);
    Route::put('/biller-kartu-perdana/{id}/delete', [BillerKartuPerdanaController::class, 'delete']);
    
    // Pembelian Biller Pulsa
    Route::get('/pembelian-biller-pulsa', [PembelianBillerPulsaController::class, 'index']);
    Route::get('/pembelian-biller-pulsa/filter-date', [PembelianBillerPulsaController::class, 'filterDate']);
    Route::get('/pembelian-biller-pulsa/add', [PembelianBillerPulsaController::class, 'add']);
    Route::post('/pembelian-biller-pulsa/create', [PembelianBillerPulsaController::class, 'create']);
    Route::get('/pembelian-biller-pulsa/export-pdf', [PembelianBillerPulsaController::class, 'exportPdf']);
    Route::get('/pembelian-biller-pulsa/{id}/edit', [PembelianBillerPulsaController::class, 'edit']);
    Route::put('/pembelian-biller-pulsa/{id}/update', [PembelianBillerPulsaController::class, 'update']);
    Route::put('/pembelian-biller-pulsa/{id}/delete', [PembelianBillerPulsaController::class, 'delete']);
    
    // Pembelian Biller Kartu Perdana
    Route::get('/pembelian-biller-kartu-perdana', [PembelianBillerKartuPerdanaController::class, 'index']);
    Route::get('/pembelian-biller-kartu-perdana/filter-date', [PembelianBillerKartuPerdanaController::class, 'filterDate']);
    Route::get('/pembelian-biller-kartu-perdana/add', [PembelianBillerKartuPerdanaController::class, 'add']);
    Route::post('/pembelian-biller-kartu-perdana/create', [PembelianBillerKartuPerdanaController::class, 'create']);
    Route::get('/pembelian-biller-kartu-perdana/export-pdf', [PembelianBillerKartuPerdanaController::class, 'exportPdf']);
    Route::get('/pembelian-biller-kartu-perdana/{id}/edit', [PembelianBillerKartuPerdanaController::class, 'edit']);
    Route::put('/pembelian-biller-kartu-perdana/{id}/update', [PembelianBillerKartuPerdanaController::class, 'update']);
    Route::put('/pembelian-biller-kartu-perdana/{id}/delete', [PembelianBillerKartuPerdanaController::class, 'delete']);
    
    // Penjualan Biller Pulsa
    Route::get('/penjualan-biller-pulsa', [PenjualanBillerPulsaController::class, 'index']);
    Route::get('/penjualan-biller-pulsa/filter-date', [PenjualanBillerPulsaController::class, 'filterDate']);
    Route::get('/penjualan-biller-pulsa/add', [PenjualanBillerPulsaController::class, 'add']);
    Route::post('/penjualan-biller-pulsa/create', [PenjualanBillerPulsaController::class, 'create']);
    Route::get('/penjualan-biller-pulsa/export-pdf', [PenjualanBillerPulsaController::class, 'exportPdf']);
    Route::get('/penjualan-biller-pulsa/{id}/edit', [PenjualanBillerPulsaController::class, 'edit']);
    Route::put('/penjualan-biller-pulsa/{id}/update', [PenjualanBillerPulsaController::class, 'update']);
    Route::put('/penjualan-biller-pulsa/{id}/delete', [PenjualanBillerPulsaController::class, 'delete']);
    
    // Penjualan Biller Kartu Perdana
    Route::get('/penjualan-biller-kartu-perdana', [PenjualanBillerKartuPerdanaController::class, 'index']);
    Route::get('/penjualan-biller-kartu-perdana/filter-date', [PenjualanBillerKartuPerdanaController::class, 'filterDate']);
    Route::get('/penjualan-biller-kartu-perdana/add', [PenjualanBillerKartuPerdanaController::class, 'add']);
    Route::post('/penjualan-biller-kartu-perdana/create', [PenjualanBillerKartuPerdanaController::class, 'create']);
    Route::get('/penjualan-biller-kartu-perdana/export-pdf', [PenjualanBillerKartuPerdanaController::class, 'exportPdf']);
    Route::get('/penjualan-biller-kartu-perdana/{id}/edit', [PenjualanBillerKartuPerdanaController::class, 'edit']);
    Route::put('/penjualan-biller-kartu-perdana/{id}/update', [PenjualanBillerKartuPerdanaController::class, 'update']);
    Route::put('/penjualan-biller-kartu-perdana/{id}/delete', [PenjualanBillerKartuPerdanaController::class, 'delete']);
});


