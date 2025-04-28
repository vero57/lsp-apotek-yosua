<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // Tampilkan form register
    public function showRegisterForm()
    {
        return view('fe.auth.register');
    }

    // Proses register (dummy)
    public function register(Request $request)
    {
        // Validasi sederhana
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Dummy register: langsung redirect ke home
        // Implementasi register asli menggunakan User::create()
        return redirect()->route('fe.index');
    }
}
