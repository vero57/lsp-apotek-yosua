<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EditUserController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $jabatans = ['admin', 'apotekar', 'karyawan', 'kasir', 'pemilik'];
        return view('be.pages.editusers', compact('user', 'jabatans'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'jabatan' => 'required|in:admin,apotekar,karyawan,kasir,pemilik',
        ]);

        $user->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->route('be.admin.users')->with('success', 'User berhasil diupdate!');
    }
}
