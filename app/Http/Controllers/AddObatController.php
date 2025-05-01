<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\JenisObat;

class AddObatController extends Controller
{
    public function create()
    {
        $jenisObat = JenisObat::all();
        return view('be.pages.addobat', compact('jenisObat'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'harga_jual' => str_replace('.', '', $request->harga_jual)
        ]);

        $request->validate([
            'nama_obat'      => 'required|string|max:255',
            'idjenis'        => 'nullable', // boleh kosong
            'harga_jual'     => 'required|numeric|min:0',
            'deskripsi_obat' => 'required|string',
            'stok'           => 'required|integer|min:0',
            'foto1'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto2'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto3'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'nama_obat'      => $request->nama_obat,
            'idjenis'        => $request->idjenis,
            'harga_jual'     => $request->harga_jual,
            'deskripsi_obat' => $request->deskripsi_obat,
            'stok'           => $request->stok,
        ];

        foreach (['foto1', 'foto2', 'foto3'] as $foto) {
            if ($request->hasFile($foto)) {
                $data[$foto] = $request->file($foto)->store('obat', 'public');
            }
        }

        Product::create($data);

        return redirect()->route('be.admin.products')->with('success', 'Obat berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'harga_jual' => str_replace('.', '', $request->harga_jual)
        ]);

        // validasi dan proses update
    }

    public function destroy($id)
    {
        $obats = Obat::findOrFail($id);
        $obats->delete();
        return redirect()->route('be.admin.products')->with('success', 'Obat berhasil dihapus!');
    }
}
