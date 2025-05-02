<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembelianObat;
use App\Models\Distributor;

class EditPembelianObatController extends Controller
{
    public function edit($id)
    {
        $pembelianobat = PembelianObat::findOrFail($id);
        $distributors = Distributor::all();
        return view('be.pages.editpembelianobat', compact('pembelianobat', 'distributors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nonota' => 'required|string|max:255',
            'tgl_pembelian' => 'required|date',
            'total_bayar' => 'required|numeric|min:0',
            'id_distributor' => 'required|exists:distributor,id',
        ]);

        $pembelianobat = PembelianObat::findOrFail($id);
        $pembayaran = str_replace('.', '', $request->total_bayar);

        $pembelianobat->update([
            'nonota' => $request->nonota,
            'tgl_pembelian' => $request->tgl_pembelian,
            'total_bayar' => $pembayaran,
            'id_distributor' => $request->id_distributor,
        ]);

        return redirect()->route('be.admin.pembelianobat')->with('success', 'Pembelian obat berhasil diupdate');
    }
}
