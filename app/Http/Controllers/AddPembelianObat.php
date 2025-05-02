<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distributor;
use App\Models\PembelianObat;

class AddPembelianObat extends Controller
{
    public function create()
    {
        $distributors = Distributor::all();
        return view('be.pages.addpembelianobat', compact('distributors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nonota' => 'required|string|max:255',
            'tgl_pembelian' => 'required|date',
            'total_bayar' => 'required|numeric|min:0',
            'id_distributor' => 'required|exists:distributor,id',
        ]);

        PembelianObat::create([
            'nonota' => $request->nonota,
            'tgl_pembelian' => $request->tgl_pembelian,
            'total_bayar' => $request->total_bayar,
            'id_distributor' => $request->id_distributor,
        ]);

        return redirect()->route('be.admin.pembelianobat')->with('success', 'Pembelian obat berhasil ditambahkan');
    }
}
