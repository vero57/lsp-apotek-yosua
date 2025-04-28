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
    MyAccountController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('fe.index');
Route::get('/about', [AboutController::class, 'index'])->name('fe.about');
Route::get('/cart', [CartController::class, 'index'])->name('fe.cart');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('fe.checkout');
Route::get('/contact', [ContactController::class, 'index'])->name('fe.contact');
Route::get('/product-details', [ProductDetailsController::class, 'index'])->name('fe.product-details');
Route::get('/shop', [ShopController::class, 'index'])->name('fe.shop');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('fe.wishlist');
Route::get('/my-account', [MyAccountController::class, 'index'])->name('fe.my_account');

// FE Auth routes
Route::get('/login', function () {
    return view('fe.auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = DB::table('users')->where('email', $request->email)->first();

    if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        // Simpan session login sederhana (untuk debug, bukan production)
        session([
            'user_id' => $user->id,
            'user_email' => $user->email,
            'user_name' => $user->name,
        ]);
        return redirect()->route('fe.index');
    } else {
        return redirect()->route('login')->withInput()->withErrors([
            'email' => 'Email or password is incorrect.',
        ]);
    }
});

Route::post('/logout', function (Request $request) {
    $request->session()->flush();
    return redirect()->route('login');
})->name('logout');

Route::get('/register', function () {
    return view('fe.auth.register');
})->name('register');

Route::post('/register', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    DB::table('users')->insert([
        'name' => $request->name,
        'email' => $request->email,
        'email_verified_at' => null,
        'password' => Hash::make($request->password),
        'jabatan' => 'pelanggan',
        'remember_token' => null,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('login')->with('success', 'Registration successful! Please login.');
});
