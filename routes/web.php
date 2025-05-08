<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    AboutController,
    CartController,
    CheckoutController,
    ContactController,
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
    EditPembelianObatController
};
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

// ==================== ROUTE FE (Pelanggan) ====================

// Route ke halaman utama (tampilan untuk Pelanggan) FE
Route::get('/', [HomeController::class, 'index'])->name('fe.index');
Route::get('/about', [AboutController::class, 'index'])->name('fe.about');
Route::get('/cart', [CartController::class, 'index'])->middleware('apotek');
Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('apotek');
Route::get('/wishlist', [WishlistController::class, 'index'])->middleware('apotek')->name('fe.wishlist');
Route::get('/my-account', [MyAccountController::class, 'index'])->middleware('apotek')->name('fe.my_account');
Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('apotek')->name('fe.checkout');
Route::get('/contact', [ContactController::class, 'index'])->name('fe.contact');
Route::get('/product-details', [ProductDetailsController::class, 'index'])->name('fe.product-details');
Route::get('/shop', [ShopController::class, 'index'])->name('fe.shop');
Route::get('/product/{id}', [App\Http\Controllers\ShopController::class, 'show'])->name('fe.product-details');

// Route ke halaman login dan register (tampilan untuk Pelanggan)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', function (Request $request) {
    $request->session()->flush();
    return redirect()->route('login');
})->name('logout');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// ==================== ROUTE BE (Admin & User Table Users) ====================

// Route ke halaman login dan register (tampilan untuk Admin dan akun yang ada di table users lainnya)
Route::get('/dash/login', [\App\Http\Controllers\Auth\LoginBeController::class, 'showLoginForm'])->name('be.login');
Route::post('/dash/login', [\App\Http\Controllers\Auth\LoginBeController::class, 'login'])->name('be.login.submit');
Route::post('/dash/logout', [\App\Http\Controllers\Auth\LoginBeController::class, 'logout'])->name('be.logout');

// Group semua route admin dengan middleware admin
Route::middleware('admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('be.admin.index');
    Route::get('/admin/users', [UserbeController::class, 'index'])->name('be.admin.users');
    Route::get('/admin/users/create', [\App\Http\Controllers\AddusersController::class, 'create'])->name('be.admin.users.create');
    Route::post('/admin/users', [\App\Http\Controllers\AddusersController::class, 'store'])->name('be.admin.users.store');
    Route::get('/admin/users/{user}/edit', [\App\Http\Controllers\EditUserController::class, 'edit'])->name('be.admin.users.edit');
    Route::put('/admin/users/{user}', [\App\Http\Controllers\EditUserController::class, 'update'])->name('be.admin.users.update');
    Route::delete('/admin/users/{user}', [\App\Http\Controllers\UserbeController::class, 'destroy'])->name('be.admin.users.destroy');

    Route::get('/admin/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('be.admin.products');
    Route::get('/admin/products/create', [\App\Http\Controllers\AddObatController::class, 'create'])->name('be.admin.products.create');
    Route::post('/admin/products', [\App\Http\Controllers\AddObatController::class, 'store'])->name('be.admin.products.store');
    Route::get('/admin/products/{id}/edit', [\App\Http\Controllers\EditObatController::class, 'edit'])->name('be.admin.products.edit');
    Route::put('/admin/products/{id}', [\App\Http\Controllers\EditObatController::class, 'update'])->name('be.admin.products.update');
    Route::get('/admin/products/create-jenis', [\App\Http\Controllers\AddJenisObat::class, 'create'])->name('be.admin.products.createjenis');
    Route::post('/admin/products/store-jenis', [\App\Http\Controllers\AddJenisObat::class, 'store'])->name('be.admin.products.storejenis');
    Route::delete('/admin/products/jenis/{id}', [\App\Http\Controllers\AddJenisObat::class, 'destroy'])->name('be.admin.products.destroyjenis');
    Route::delete('/admin/products/{id}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('be.admin.products.destroy');

    Route::get('/admin/pelanggan', [\App\Http\Controllers\PagePelangganController::class, 'index'])->name('be.admin.pelanggan');

    Route::get('/admin/distributor', [DistributorController::class, 'index'])->name('be.admin.distributor');
    Route::delete('/admin/distributor/{id}', [DistributorController::class, 'destroy'])->name('be.admin.distributor.destroy');
    Route::get('/admin/distributor/create', [AddDistributorController::class, 'create'])->name('be.admin.distributor.create');
    Route::post('/admin/distributor', [AddDistributorController::class, 'store'])->name('be.admin.distributor.store');
    Route::get('/admin/distributor/{id}/edit', [EditDistributorController::class, 'edit'])->name('be.admin.distributor.edit');
    Route::put('/admin/distributor/{id}', [EditDistributorController::class, 'update'])->name('be.admin.distributor.update');

    Route::get('/admin/pembelian-obat', [PembelianObatController::class, 'index'])->name('be.admin.pembelianobat');
    Route::get('/admin/pembelian-obat/create', [AddPembelianObat::class, 'create'])->name('be.admin.pembelianobat.create');
    Route::post('/admin/pembelian-obat', [AddPembelianObat::class, 'store'])->name('be.admin.pembelianobat.store');
    Route::get('/admin/pembelian-obat/{id}/edit', [EditPembelianObatController::class, 'edit'])->name('be.admin.pembelianobat.edit');
    Route::put('/admin/pembelian-obat/{id}', [EditPembelianObatController::class, 'update'])->name('be.admin.pembelianobat.update');
    Route::delete('/admin/pembelian-obat/{id}', [PembelianObatController::class, 'destroy'])->name('be.admin.pembelianobat.destroy');
    Route::get('/admin/pembelian-obat/create-detail', [\App\Http\Controllers\AddDetailPembelianObatController::class, 'create'])->name('be.admin.pembelianobat.detail.create');
    Route::post('/admin/pembelian-obat/create-detail', [\App\Http\Controllers\AddDetailPembelianObatController::class, 'store'])->name('be.admin.pembelianobat.detail.store');
    Route::get('/admin/pembelian-obat/{id}/detail', [\App\Http\Controllers\PembelianObatController::class, 'detail'])->name('be.admin.pembelianobat.detail');
});

// ==================== ROUTE APOTEKAR (khusus jabatan apotekker) ====================
Route::middleware('admin')->prefix('apotekar')->name('be.apotekar.')->group(function () {
    // Main route apotekar: langsung ke distributor
    Route::get('/', function () {
        return redirect()->route('be.apotekar.distributor');
    })->name('home');

    // Distributor routes
    Route::get('/distributor', [DistributorController::class, 'index'])->name('distributor');
    Route::get('/distributor/create', [AddDistributorController::class, 'create'])->name('distributor.create');
    Route::post('/distributor', [AddDistributorController::class, 'store'])->name('distributor.store');
    Route::get('/distributor/{id}/edit', [EditDistributorController::class, 'edit'])->name('distributor.edit');
    Route::put('/distributor/{id}', [EditDistributorController::class, 'update'])->name('distributor.update');
    Route::delete('/distributor/{id}', [DistributorController::class, 'destroy'])->name('distributor.destroy');

    // Pembelian Obat routes
    Route::get('/pembelian-obat', [PembelianObatController::class, 'index'])->name('pembelianobat');
    Route::get('/pembelian-obat/create', [AddPembelianObat::class, 'create'])->name('pembelianobat.create');
    Route::post('/pembelian-obat', [AddPembelianObat::class, 'store'])->name('pembelianobat.store');
    Route::get('/pembelian-obat/{id}/edit', [EditPembelianObatController::class, 'edit'])->name('pembelianobat.edit');
    Route::put('/pembelian-obat/{id}', [EditPembelianObatController::class, 'update'])->name('pembelianobat.update');
    Route::delete('/pembelian-obat/{id}', [PembelianObatController::class, 'destroy'])->name('pembelianobat.destroy');

    // Tambahkan route add detail pembelian untuk apotekar
    Route::get('/pembelian-obat/create-detail', [\App\Http\Controllers\AddDetailPembelianObatController::class, 'create'])->name('pembelianobat.detail.create');
    Route::post('/pembelian-obat/create-detail', [\App\Http\Controllers\AddDetailPembelianObatController::class, 'store'])->name('pembelianobat.detail.store');
    Route::get('/pembelian-obat/{id}/detail', [\App\Http\Controllers\PembelianObatController::class, 'detail'])->name('pembelianobat.detail');

    // ...existing code...
});


