<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('fe.auth.login');
    }

    // Proses login (dummy)
    public function login(Request $request)
    {
        // Validasi sederhana
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Dummy login: langsung redirect ke home
        // Implementasi login asli menggunakan Auth::attempt()
        return redirect()->route('fe.index');
    }
}
