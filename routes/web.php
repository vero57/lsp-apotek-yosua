<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    AboutController,
    CartController,
    CheckoutController,
    ProductDetailsController,
    ShopController,     
    WishlistController,
    MyAccountController,
    AdminController,
    UserbeController,
    DistributorController,
    AddDistributorController,
    EditDistributorController,
    PembelianObatController,
    AddPembelianObat,
    EditPembelianObatController,
    StatusController
};
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

// ==================== ROUTE FE (Pelanggan) ====================

Route::prefix('/')->group(function () {
    Route::get('', [HomeController::class, 'index'])->name('fe.index');
    Route::get('about', [AboutController::class, 'index'])->name('fe.about');
    Route::get('cart', [CartController::class, 'index'])->middleware('apotek')->name('fe.cart');
    Route::get('checkout', [CheckoutController::class, 'index'])->middleware('apotek')->name('fe.checkout');
    Route::get('wishlist', [WishlistController::class, 'index'])->middleware('apotek')->name('fe.wishlist');
    Route::get('my-account', [MyAccountController::class, 'index'])->middleware('apotek')->name('fe.my_account');
    Route::get('status', [StatusController::class, 'index'])->middleware('apotek')->name('fe.status');
    Route::get('contact', [ContactController::class, 'index'])->name('fe.contact');
    Route::get('product-details', [ProductDetailsController::class, 'index'])->name('fe.product-details');
    Route::get('shop', [ShopController::class, 'index'])->name('fe.shop');
    Route::get('product/{id}', [App\Http\Controllers\ShopController::class, 'show'])->name('fe.product-details');
    Route::post('cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('fe.cart.add');
    Route::post('cart/delete', [\App\Http\Controllers\CartController::class, 'delete'])->name('fe.cart.delete');
    Route::post('cart/process-checkout', [\App\Http\Controllers\CartController::class, 'processCheckout'])->name('fe.cart.processCheckout');
    Route::post('checkout/pay', [CheckoutController::class, 'pay'])->middleware('apotek')->name('fe.checkout.pay');
    Route::post('my-account/update', [MyAccountController::class, 'update'])->middleware('apotek')->name('fe.my_account.update');
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', function (Request $request) {
        $request->session()->flush();
        return redirect()->route('login');
    })->name('logout');
    Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

// ==================== ROUTE BE (Admin & User Table Users) ====================

Route::prefix('dash')->group(function () {
    Route::get('login', [\App\Http\Controllers\Auth\LoginBeController::class, 'showLoginForm'])->name('be.login');
    Route::post('login', [\App\Http\Controllers\Auth\LoginBeController::class, 'login'])->name('be.login.submit');
    Route::post('logout', [\App\Http\Controllers\Auth\LoginBeController::class, 'logout'])->name('be.logout');
});

// ==================== ROUTE ADMIN ====================
Route::middleware('admin')->prefix('admin')->name('be.admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('users', [UserbeController::class, 'index'])->name('users');
    Route::get('users/create', [\App\Http\Controllers\AddusersController::class, 'create'])->name('users.create');
    Route::post('users', [\App\Http\Controllers\AddusersController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [\App\Http\Controllers\EditUserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [\App\Http\Controllers\EditUserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [\App\Http\Controllers\UserbeController::class, 'destroy'])->name('users.destroy');

    Route::get('products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products');
    Route::get('products/create', [\App\Http\Controllers\AddObatController::class, 'create'])->name('products.create');
    Route::post('products', [\App\Http\Controllers\AddObatController::class, 'store'])->name('products.store');
    Route::get('products/{id}/edit', [\App\Http\Controllers\EditObatController::class, 'edit'])->name('products.edit');
    Route::put('products/{id}', [\App\Http\Controllers\EditObatController::class, 'update'])->name('products.update');
    Route::get('products/create-jenis', [\App\Http\Controllers\AddJenisObat::class, 'create'])->name('products.createjenis');
    Route::post('products/store-jenis', [\App\Http\Controllers\AddJenisObat::class, 'store'])->name('products.storejenis');
    Route::delete('products/jenis/{id}', [\App\Http\Controllers\AddJenisObat::class, 'destroy'])->name('products.destroyjenis');
    Route::delete('products/{id}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('pelanggan', [\App\Http\Controllers\PagePelangganController::class, 'index'])->name('pelanggan');

    Route::get('distributor', [DistributorController::class, 'index'])->name('distributor');
    Route::delete('distributor/{id}', [DistributorController::class, 'destroy'])->name('distributor.destroy');
    Route::get('distributor/create', [AddDistributorController::class, 'create'])->name('distributor.create');
    Route::post('distributor', [AddDistributorController::class, 'store'])->name('distributor.store');
    Route::get('distributor/{id}/edit', [EditDistributorController::class, 'edit'])->name('distributor.edit');
    Route::put('distributor/{id}', [EditDistributorController::class, 'update'])->name('distributor.update');

    Route::get('pembelian-obat', [PembelianObatController::class, 'index'])->name('pembelianobat');
    Route::get('pembelian-obat/create', [AddPembelianObat::class, 'create'])->name('pembelianobat.create');
    Route::post('pembelian-obat', [AddPembelianObat::class, 'store'])->name('pembelianobat.store');
    Route::get('pembelian-obat/{id}/edit', [EditPembelianObatController::class, 'edit'])->name('pembelianobat.edit');
    Route::put('pembelian-obat/{id}', [EditPembelianObatController::class, 'update'])->name('pembelianobat.update');
    Route::delete('pembelian-obat/{id}', [PembelianObatController::class, 'destroy'])->name('pembelianobat.destroy');
    Route::get('pembelian-obat/create-detail', [\App\Http\Controllers\AddDetailPembelianObatController::class, 'create'])->name('pembelianobat.detail.create');
    Route::post('pembelian-obat/create-detail', [\App\Http\Controllers\AddDetailPembelianObatController::class, 'store'])->name('pembelianobat.detail.store');
    Route::get('pembelian-obat/{id}/detail', [\App\Http\Controllers\PembelianObatController::class, 'detail'])->name('pembelianobat.detail');

    Route::get('create', [\App\Http\Controllers\AddJenisPengirimanController::class, 'create'])->name('jenispengiriman.create');
    Route::post('create', [\App\Http\Controllers\AddJenisPengirimanController::class, 'store'])->name('jenispengiriman.store');
    Route::get('jenis-pengiriman', [\App\Http\Controllers\JenisPengirimanController::class, 'index'])->name('jenispengiriman');
    Route::get('jenis-pengiriman/{id}/edit', [\App\Http\Controllers\EditJenisPengirimanController::class, 'edit'])->name('jenispengiriman.edit');
    Route::put('jenis-pengiriman/{id}', [\App\Http\Controllers\EditJenisPengirimanController::class, 'update'])->name('jenispengiriman.update');
    Route::delete('jenis-pengiriman/{id}', [\App\Http\Controllers\AddJenisPengirimanController::class, 'destroy'])->name('jenispengiriman.destroy');

    Route::get('penjualan', [\App\Http\Controllers\PenjualanController::class, 'index'])->name('penjualan');
});

// ==================== ROUTE APOTEKAR ====================
Route::middleware('admin')->prefix('apotekar')->name('be.apotekar.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('be.apotekar.distributor');
    })->name('home');
    Route::get('distributor', [DistributorController::class, 'index'])->name('distributor');
    Route::get('distributor/create', [AddDistributorController::class, 'create'])->name('distributor.create');
    Route::post('distributor', [AddDistributorController::class, 'store'])->name('distributor.store');
    Route::get('distributor/{id}/edit', [EditDistributorController::class, 'edit'])->name('distributor.edit');
    Route::put('distributor/{id}', [EditDistributorController::class, 'update'])->name('distributor.update');
    Route::delete('distributor/{id}', [DistributorController::class, 'destroy'])->name('distributor.destroy');
    Route::get('pembelian-obat', [PembelianObatController::class, 'index'])->name('pembelianobat');
    Route::get('pembelian-obat/create', [AddPembelianObat::class, 'create'])->name('pembelianobat.create');
    Route::post('pembelian-obat', [AddPembelianObat::class, 'store'])->name('pembelianobat.store');
    Route::get('pembelian-obat/{id}/edit', [EditPembelianObatController::class, 'edit'])->name('pembelianobat.edit');
    Route::put('pembelian-obat/{id}', [EditPembelianObatController::class, 'update'])->name('pembelianobat.update');
    Route::delete('pembelian-obat/{id}', [PembelianObatController::class, 'destroy'])->name('pembelianobat.destroy');
    Route::get('pembelian-obat/create-detail', [\App\Http\Controllers\AddDetailPembelianObatController::class, 'create'])->name('pembelianobat.detail.create');
    Route::post('pembelian-obat/create-detail', [\App\Http\Controllers\AddDetailPembelianObatController::class, 'store'])->name('pembelianobat.detail.store');
    Route::get('pembelian-obat/{id}/detail', [\App\Http\Controllers\PembelianObatController::class, 'detail'])->name('pembelianobat.detail');
});

// ==================== ROUTE PEMILIK ====================
Route::middleware('admin')->prefix('pemilik')->name('be.pemilik.')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('index');
});

// ==================== ROUTE KARYAWAN ====================
Route::middleware('admin')->prefix('karyawan')->name('be.karyawan.')->group(function () {
    Route::get('products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products');
    Route::get('jenis-pengiriman', [\App\Http\Controllers\JenisPengirimanController::class, 'index'])->name('jenispengiriman');
});

// ==================== ROUTE KASIR ====================
Route::middleware('admin')->prefix('kasir')->name('be.kasir.')->group(function () {
    Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('products');
    Route::get('penjualan', [\App\Http\Controllers\PenjualanController::class, 'index'])->name('penjualan');
});

// ==================== ROUTE GLOBAL (Tanpa Prefix) ====================

Route::post('/midtrans/callback', [CheckoutController::class, 'midtransCallback'])->name('midtrans.callback');
Route::post('/penjualan/update-status', [\App\Http\Controllers\PenjualanController::class, 'updateStatus'])->name('penjualan.updateStatus');
Route::post('/penjualan/cancel-order', [\App\Http\Controllers\PenjualanController::class, 'cancelOrder'])->name('penjualan.cancelOrder');
Route::get('/penjualan/pdf', [\App\Http\Controllers\PenjualanController::class, 'exportPdf'])->name('penjualan.exportPdf');




