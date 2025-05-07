<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembelianObat;
use App\Models\DetailPembelianObat;
use App\Models\Product;

class PembelianObatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $pembelianobat = PembelianObat::with('distributor')
            ->when($search, function ($query) use ($search) {
                $query->where('nonota', 'like', "%{$search}%")
                    ->orWhereHas('distributor', function($q) use ($search) {
                        $q->where('nama_distributor', 'like', "%{$search}%");
                    });
            })
            ->get();

        return view('be.pages.pembelianobat', compact('pembelianobat'));
    }

    public function destroy($id)
    {
        // Hapus semua detail pembelian terkait
        \App\Models\DetailPembelianObat::where('id_pembelian', $id)->delete();

        // Hapus data pembelian
        PembelianObat::destroy($id);

        $user = auth('web')->user();
        $route = ($user && $user->jabatan === 'apotekar') ? 'be.apotekar.pembelianobat' : 'be.admin.pembelianobat';
        return redirect()->route($route)->with('success', 'Data pembelian obat berhasil dihapus');
    }

    public function detail($id)
    {
        $details = DetailPembelianObat::with('obat')
            ->where('id_pembelian', $id)
            ->get();

        $result = [];
        foreach ($details as $row) {
            $result[] = [
                'nama_obat' => $row->obat ? $row->obat->nama_obat : '-',
                'jumlah_beli' => $row->jumlah_beli,
                'harga_beli' => $row->harga_beli,
                'subtotal' => $row->subtotal,
                'nonota' => $row->pembelian ? $row->pembelian->nonota : '',
            ];
        }

        return response()->json([
            'success' => true,
            'details' => $result,
        ]);
    }
}
