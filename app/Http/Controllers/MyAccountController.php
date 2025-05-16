<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyAccountController extends Controller
{
    public function index(Request $request)
    {
        // Bisa tambahkan logic lain jika perlu
        return view('fe.my_account');
    }
    
    public function update(Request $request)
    {
        $pelanggan = \App\Models\Pelanggan::find(session('user_id'));
        if (!$pelanggan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->email = $request->email;
        if ($request->filled('katakunci')) {
            $pelanggan->katakunci = bcrypt($request->katakunci);
        }
        $pelanggan->no_telp = $request->no_telp;
        $pelanggan->alamat1 = $request->alamat1;
        $pelanggan->kota1 = $request->kota1;
        $pelanggan->propinsi1 = $request->propinsi1;
        $pelanggan->kodepos1 = $request->kodepos1;
        $pelanggan->alamat2 = $request->alamat2;
        $pelanggan->kota2 = $request->kota2;
        $pelanggan->propinsi2 = $request->propinsi2;
        $pelanggan->kodepos2 = $request->kodepos2;
        $pelanggan->alamat3 = $request->alamat3;
        $pelanggan->kota3 = $request->kota3;
        $pelanggan->propinsi3 = $request->propinsi3;
        $pelanggan->kodepos3 = $request->kodepos3;

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('pelanggan', 'public');
            $pelanggan->foto = $foto;
        }

        $pelanggan->save();

        return redirect()->route('fe.my_account')->with('success', 'Profil berhasil diperbarui');
    }
}
