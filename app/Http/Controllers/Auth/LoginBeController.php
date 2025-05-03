<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginBeController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('be.auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari user berdasarkan kolom name (bukan username)
        $user = User::where('name', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            if ($user->jabatan === 'apotekar') {
                return redirect()->route('be.apotekar.distributor');
            }
            return redirect()->route('be.admin.index');
        }

        return back()->with('error', 'Nama atau password salah.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('be.login');
    }
}
