<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Nanti ambil data produk dari database, untuk sekarang tampilkan view saja
        return view('be.pages.product');
    }

    public function decreaseStock($id, $qty)
    {
        $product = Product::findOrFail($id);
        if ($product->stok - $qty < 0) {
            return back()->with('error', 'Stok tidak boleh kurang dari 0');
        }
        $product->stok -= $qty;
        $product->save();
        return back()->with('success', 'Stok berhasil dikurangi');
    }
}
