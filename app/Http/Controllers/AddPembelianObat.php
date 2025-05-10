<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distributor;
use App\Models\PembelianObat;
use App\Models\DetailPembelianObat;
use App\Models\Product;

class AddPembelianObat extends Controller
{
    public function create()
    {
        $distributors = Distributor::all();
        $obats = Product::all(['id', 'nama_obat']);
        return view('be.pages.addpembelianobat', compact('distributors', 'obats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nonota' => 'required|string|max:255',
            'tgl_pembelian' => 'required|date',
            'id_distributor' => 'required|exists:distributor,id',
            'id_obat' => 'required|exists:obat,id',
            'jumlah_beli' => 'required|integer|min:1',
            'harga_beli' => 'required|integer|min:0',
            'subtotal' => 'required|integer|min:0',
        ]);

        // Simpan ke tabel pembelian
        $pembelian = PembelianObat::create([
            'nonota' => $request->nonota,
            'tgl_pembelian' => $request->tgl_pembelian,
            'total_bayar' => $request->subtotal,
            'id_distributor' => $request->id_distributor,
        ]);

        // Simpan ke tabel detail_pembelian
        DetailPembelianObat::create([
            'id_pembelian' => $pembelian->id,
            'id_obat' => $request->id_obat,
            'jumlah_beli' => $request->jumlah_beli,
            'harga_beli' => $request->harga_beli,
            'subtotal' => $request->subtotal,
        ]);

        $user = auth('web')->user();
        $route = ($user && $user->jabatan === 'apotekar') ? 'be.apotekar.pembelianobat' : 'be.admin.pembelianobat';
        return redirect()->route($route)->with('success', 'Pembelian obat berhasil ditambahkan');
    }
}
