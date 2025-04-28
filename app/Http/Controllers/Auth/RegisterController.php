<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Tampilkan form register
    public function showRegisterForm()
    {
        return view('fe.auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggan,email',
            'no_telp' => 'required|string|max:20|unique:pelanggan,no_telp',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.unique' => 'Email sudah digunakan.',
            'no_telp.unique' => 'No telp sudah digunakan.',
        ]);

        DB::table('pelanggan')->insert([
            'nama_pelanggan' => $request->name,
            'email' => $request->email,
            'katakunci' => Hash::make($request->password),
            'no_telp' => $request->no_telp,
            'alamat1' => null,
            'kota1' => null,
            'propinsi1' => null,
            'kodepos1' => null,
            'alamat2' => null,
            'kota2' => null,
            'propinsi2' => null,
            'kodepos2' => null,
            'alamat3' => null,
            'kota3' => null,
            'propinsi3' => null,
            'kodepos3' => null,
            'foto' => null,
            'url_ktp' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }
}
