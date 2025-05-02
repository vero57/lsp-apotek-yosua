<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembelianObat;

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
        PembelianObat::destroy($id);
        return redirect()->route('be.admin.pembelianobat')->with('success', 'Data pembelian obat berhasil dihapus');
    }
}
