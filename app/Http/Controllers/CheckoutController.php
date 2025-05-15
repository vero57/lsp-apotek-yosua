<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisPengiriman;

// Tambahkan use Midtrans
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index()
    {
        // Konfigurasi Midtrans
        MidtransConfig::$serverKey = config('midtrans.server_key');
        MidtransConfig::$isProduction = config('midtrans.is_production');
        MidtransConfig::$isSanitized = config('midtrans.is_sanitized');
        MidtransConfig::$is3ds = config('midtrans.is_3ds');

        $cartItems = [];
        $cartTotal = 0;
        if (session('user_id')) {
            $cartItems = \App\Models\Keranjang::with('obat')
                ->where('id_pelanggan', session('user_id'))
                ->get();
            $cartTotal = $cartItems->sum('subtotal');
        }
        $jenisPengiriman = JenisPengiriman::all();

        return view('fe.checkout', compact('cartItems', 'cartTotal', 'jenisPengiriman'));
    }

    public function pay(Request $request)
    {
        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        // Ambil data user dan cart
        $userId = session('user_id');
        $user = \App\Models\Pelanggan::find($userId);
        $cartItems = \App\Models\Keranjang::with('obat')
            ->where('id_pelanggan', $userId)
            ->get();
        $cartTotal = $cartItems->sum('subtotal');

        // Komponen biaya lain
        $proteksiProduk = 500;
        $subtotalPengiriman = 10000;
        $biayaLayanan = 2000;
        $totalPembayaran = $cartTotal + $proteksiProduk + $subtotalPengiriman + $biayaLayanan;

        // Data transaksi untuk Snap
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . uniqid() . '-' . time(), // pastikan benar-benar unik
                'gross_amount' => $totalPembayaran,
            ],
            'customer_details' => [
                'first_name' => $user ? $user->nama_pelanggan : 'Customer',
                'email' => $user ? $user->email : 'customer@email.com',
            ],
            // Anda bisa menambahkan item_details jika ingin
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json(['snapToken' => $snapToken]);
    }
}
