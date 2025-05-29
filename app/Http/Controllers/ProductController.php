<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\JenisObat;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $productsQuery = \App\Models\Product::with('jenisObat');
        $jenisObatQuery = \App\Models\JenisObat::query();

        if ($request->filled('search')) {
            $search = $request->search;
            // Filter produk berdasarkan nama_obat (case-insensitive)
            $productsQuery->whereRaw('LOWER(nama_obat) LIKE ?', ['%' . strtolower($search) . '%']);
            // Filter jenis obat berdasarkan jenis (case-insensitive)
            $jenisObatQuery->whereRaw('LOWER(jenis) LIKE ?', ['%' . strtolower($search) . '%']);
        }

        $products = $productsQuery->get();
        $jenisObat = $jenisObatQuery->get();
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

        // Hapus semua keranjang yang terkait produk ini
        \App\Models\Keranjang::where('id_obat', $id)->delete();

        // Hapus semua detail_pembelian yang terkait produk ini
        \DB::table('detail_pembelian')->where('id_obat', $id)->delete();

        $product->delete();
        return redirect()->route('be.admin.products')->with('success', 'Produk berhasil dihapus');
    }
}
