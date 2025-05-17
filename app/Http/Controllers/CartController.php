<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        return view('fe.cart');
    }

    public function add(Request $request)
    {
        $request->validate([
            'id_obat' => 'required|exists:obat,id',
            'jumlah_order' => 'required|integer|min:1',
        ]);

        $userId = session('user_id');
        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Silakan login terlebih dahulu.'], 401);
        }

        $product = Product::findOrFail($request->id_obat);
        $harga = $product->harga_jual;
        $subtotal = $harga * $request->jumlah_order;

        // Jika sudah ada di keranjang, update jumlah dan subtotal
        $cart = Keranjang::where('id_pelanggan', $userId)
            ->where('id_obat', $request->id_obat)
            ->first();

        if ($cart) {
            $cart->jumlah_order += $request->jumlah_order;
            $cart->subtotal = $cart->jumlah_order * $harga;
            $cart->harga = $harga;
            $cart->save();
        } else {
            Keranjang::create([
                'id_pelanggan' => $userId,
                'id_obat' => $request->id_obat,
                'jumlah_order' => $request->jumlah_order,
                'harga' => $harga,
                'subtotal' => $subtotal,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Berhasil menambahkan ke keranjang']);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:keranjang,id',
        ]);
        $userId = session('user_id');
        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Silakan login terlebih dahulu.'], 401);
        }
        $deleted = \App\Models\Keranjang::where('id', $request->id)
            ->where('id_pelanggan', $userId)
            ->delete();

        return response()->json(['success' => $deleted ? true : false]);
    }

    public function processCheckout(Request $request)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('fe.cart')->with('error', 'Silakan login terlebih dahulu.');
        }
        $cartIds = $request->input('cart_id', []);
        $jumlahOrders = $request->input('jumlah_order', []);

        // Ambil hanya cart_id yang tidak disabled (hanya yang dikirim browser)
        // Pastikan $cartIds adalah array numerik (bisa jadi ada null jika semua disabled)
        $cartIds = array_filter($cartIds);

        // Hapus semua keranjang user yang tidak dipilih dari session (sementara, agar checkout hanya menampilkan yang dipilih)
        // Simpan cart_id terpilih ke session
        session(['checkout_cart_ids' => $cartIds]);

        // Update jumlah_order hanya untuk cart yang dipilih
        foreach ($cartIds as $cartId) {
            $cart = \App\Models\Keranjang::where('id', $cartId)
                ->where('id_pelanggan', $userId)
                ->first();
            if ($cart && isset($jumlahOrders[$cartId])) {
                $qty = max(1, intval($jumlahOrders[$cartId]));
                $cart->jumlah_order = $qty;
                $cart->subtotal = $qty * $cart->harga;
                $cart->save();
            }
        }
        return redirect()->route('fe.checkout');
    }
}
