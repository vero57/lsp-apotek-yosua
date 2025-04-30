<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisObat;

class AddJenisObat extends Controller
{
    public function create()
    {
        return view('be.pages.addjenisobat');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string|max:255',
            'deskripsi_jenis' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'jenis' => $request->jenis,
            'deskripsi_jenis' => $request->deskripsi_jenis,
        ];

        if ($request->hasFile('image_url')) {
            $data['image_url'] = $request->file('image_url')->store('jenis_obat', 'public');
        }

        JenisObat::create($data);

        return redirect()->route('be.admin.products')->with('success', 'Jenis obat berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $jenis = JenisObat::findOrFail($id);
        $jenis->delete();
        return redirect()->route('be.admin.products')->with('success_jenis', 'Jenis obat berhasil dihapus!');
    }
}
