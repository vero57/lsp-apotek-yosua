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

Route::get('/admin', [AdminController::class, 'index'])->name('be.admin.index');
Route::get('/admin/users', [UserbeController::class, 'index'])->name('be.admin.users');
Route::get('/admin/users/create', [\App\Http\Controllers\AddusersController::class, 'create'])->name('be.admin.users.create');
Route::post('/admin/users', [\App\Http\Controllers\AddusersController::class, 'store'])->name('be.admin.users.store');
Route::delete('/admin/users/{user}', [\App\Http\Controllers\UserbeController::class, 'destroy'])->name('be.admin.users.destroy');

Route::get('/admin/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('be.admin.products');
Route::get('/admin/products/create', [\App\Http\Controllers\AddObatController::class, 'create'])->name('be.admin.products.create');
Route::post('/admin/products', [\App\Http\Controllers\AddObatController::class, 'store'])->name('be.admin.products.store');


