<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\JenisObat;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('jenisObat')->get();
        $jenisObat = JenisObat::all();
        return view('be.pages.product', compact('products', 'jenisObat'));
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

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('be.admin.products')->with('success', 'Produk berhasil dihapus');
    }
}
