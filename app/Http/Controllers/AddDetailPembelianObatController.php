<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembelianObat;
use App\Models\Product;
use App\Models\DetailPembelianObat;

class AddDetailPembelianObatController extends Controller
{
    public function create()
    {
        $pembelians = PembelianObat::all(['id', 'nonota']);
        $obats = Product::all(['id', 'nama_obat']);
        return view('be.pages.adddetailpembelianobat', compact('pembelians', 'obats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pembelian' => 'required|exists:pembelian,id',
            'id_obat' => 'required|exists:obat,id',
            'jumlah_beli' => 'required|integer|min:1',
            'harga_beli' => 'required|integer|min:0',
            'subtotal' => 'required|integer|min:0',
        ]);

        DetailPembelianObat::create([
            'id_pembelian' => $request->id_pembelian,
            'id_obat' => $request->id_obat,
            'jumlah_beli' => $request->jumlah_beli,
            'harga_beli' => $request->harga_beli,
            'subtotal' => $request->subtotal,
        ]);

        return redirect()->route('be.admin.pembelianobat')->with('success', 'Detail pembelian berhasil ditambahkan');
    }
}
