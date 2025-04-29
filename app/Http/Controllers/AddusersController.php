<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AddusersController extends Controller
{
    public function create()
    {
        $jabatans = ['admin', 'apotekar', 'karyawan', 'kasir', 'pemilik'];
        return view('be.pages.addusers', compact('jabatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'jabatan'  => 'required|in:admin,apotekar,karyawan,kasir,pemilik',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'jabatan'  => $request->jabatan,
        ]);

        return redirect()->route('be.admin.users')->with('success', 'User berhasil ditambahkan!');
    }
}
