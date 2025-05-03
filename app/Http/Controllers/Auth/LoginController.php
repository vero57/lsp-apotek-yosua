<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Pelanggan;

class LoginController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('fe.auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = Pelanggan::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->katakunci)) {
            // Simpan session login sederhana (untuk debug, bukan production)
            session([
                'user_id' => $user->id,
                'user_email' => $user->email,
                'user_name' => $user->nama_pelanggan,
            ]);
            return redirect()->route('fe.index');
        } else {
            return redirect()->route('login')->withInput()->withErrors([
                'email' => 'Email or password is incorrect.',
            ]);
        }
    }
}
