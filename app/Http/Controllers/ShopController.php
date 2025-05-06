<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\JenisObat;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $jenisList = JenisObat::all();
        $query = Product::with('jenisObat');
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('nama_obat', 'like', "%$q%")
                    ->orWhereHas('jenisObat', function($jenis) use ($q) {
                        $jenis->where('jenis', 'like', "%$q%");
                    });
            });
        }
        if ($request->filled('jenis')) {
            $query->where('idjenis', $request->jenis);
        }
        $products = $query->get();
        return view('fe.shop', compact('products', 'jenisList'));
    }

    public function show($id)
    {
        $product = Product::with('jenisObat')->findOrFail($id);
        return view('fe.product-details', compact('product'));
    }
}
