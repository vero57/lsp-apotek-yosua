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
    UserbeController
};
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('fe.index');
Route::get('/about', [AboutController::class, 'index'])->name('fe.about');
// Route::get('/cart', [CartController::class, 'index'])->name('fe.cart');
Route::get('/cart', [CartController::class, 'index'])->middleware('apotek');
Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('apotek');
Route::get('/wishlist', [WishlistController::class, 'index'])->middleware('apotek')->name('fe.wishlist');
Route::get('/my-account', [MyAccountController::class, 'index'])->middleware('apotek')->name('fe.my_account');
Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('apotek')->name('fe.checkout');

// Route::get('/checkout', [CheckoutController::class, 'index'])->name('fe.checkout');
Route::get('/contact', [ContactController::class, 'index'])->name('fe.contact');
Route::get('/product-details', [ProductDetailsController::class, 'index'])->name('fe.product-details');
Route::get('/shop', [ShopController::class, 'index'])->name('fe.shop');
// Route::get('/wishlist', [WishlistController::class, 'index'])->name('fe.wishlist');

// FE Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', function (Request $request) {
    $request->session()->flush();
    return redirect()->route('login');
})->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// BE Auth routes (for /dash/login and /dash/register)
Route::get('/dash/login', [\App\Http\Controllers\Auth\LoginBeController::class, 'showLoginForm'])->name('be.login');
Route::post('/dash/login', [\App\Http\Controllers\Auth\LoginBeController::class, 'login'])->name('be.login.submit');
Route::post('/dash/logout', [\App\Http\Controllers\Auth\LoginBeController::class, 'logout'])->name('be.logout');

Route::get('/dash/register', [\App\Http\Controllers\Auth\RegisterBeController::class, 'showRegisterForm'])->name('be.register');
Route::post('/dash/register', [\App\Http\Controllers\Auth\RegisterBeController::class, 'register'])->name('be.register.submit');

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

// Route page pelanggan (BE)
Route::get('/admin/pelanggan', [\App\Http\Controllers\PagePelangganController::class, 'index'])->name('be.admin.pelanggan');

// Route page distributor (BE)
Route::get('/admin/distributor', [\App\Http\Controllers\DistributorController::class, 'index'])->name('be.admin.distributor');


