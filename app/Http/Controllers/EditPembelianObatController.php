<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembelianObat;
use App\Models\Distributor;
use App\Models\DetailPembelianObat; // tambahkan ini

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
            // validasi detail pembelian
            'id_obat' => 'required|exists:obat,id',
            'jumlah_beli' => 'required|integer|min:1',
            'harga_beli' => 'required|integer|min:0',
            'subtotal' => 'required|integer|min:0',
        ]);

        $pembelianobat = PembelianObat::findOrFail($id);
        $pembayaran = str_replace('.', '', $request->total_bayar);

        $pembelianobat->update([
            'nonota' => $request->nonota,
            'tgl_pembelian' => $request->tgl_pembelian,
            'total_bayar' => $pembayaran,
            'id_distributor' => $request->id_distributor,
        ]);

        // Update detail_pembelian (ambil satu detail, atau sesuaikan logika jika multi detail)
        $detail = DetailPembelianObat::where('id_pembelian', $pembelianobat->id)->first();
        if ($detail) {
            $detail->update([
                'id_obat' => $request->id_obat,
                'jumlah_beli' => $request->jumlah_beli,
                'harga_beli' => $request->harga_beli,
                'subtotal' => $request->subtotal,
            ]);
        } else {
            // Jika belum ada detail, buat baru
            DetailPembelianObat::create([
                'id_pembelian' => $pembelianobat->id,
                'id_obat' => $request->id_obat,
                'jumlah_beli' => $request->jumlah_beli,
                'harga_beli' => $request->harga_beli,
                'subtotal' => $request->subtotal,
            ]);
        }

        $user = auth('web')->user();
        $route = ($user && $user->jabatan === 'apotekar') ? 'be.apotekar.pembelianobat' : 'be.admin.pembelianobat';
        return redirect()->route($route)->with('success', 'Pembelian obat berhasil diupdate');
    }
}
