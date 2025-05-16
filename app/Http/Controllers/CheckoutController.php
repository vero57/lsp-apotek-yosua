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
        // Jika ada hasil midtrans dari frontend, simpan ke database
        if ($request->has('midtrans_result')) {
            $result = json_decode($request->midtrans_result, true);
            $userId = session('user_id');
            $user = \App\Models\Pelanggan::find($userId);

            $paymentType = $result['payment_type'] ?? null;
            $channel = $paymentType;
            $email = $user ? $user->email : null;

            if ($channel && $email) {
                \App\Models\MetodeBayar::create([
                    'metode_pembayaran' => $channel,
                    'tempat_bayar' => $channel,
                    'no_rekening' => $email,
                    'url_logo' => null,
                ]);
            }
            return response()->json(['success' => true]);
        }

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

        // Simpan order_id ke session untuk referensi callback
        session(['midtrans_order_id' => $params['transaction_details']['order_id']]);

        return response()->json(['snapToken' => $snapToken]);
    }

    // Endpoint untuk menerima callback/notification dari Midtrans
    public function midtransCallback(Request $request)
    {
        $json = $request->all();

        // Ambil order_id dan cari user dari session (atau mapping order_id ke user di table order jika sudah ada)
        $orderId = $json['order_id'] ?? null;
        $userId = session('user_id');
        $user = \App\Models\Pelanggan::find($userId);

        // Ambil channel pembayaran dan email user
        $paymentType = $json['payment_type'] ?? null;
        $channel = $paymentType;
        $email = $user ? $user->email : null;

        // Simpan ke database metode_bayar
        if ($channel && $email) {
            \App\Models\MetodeBayar::create([
                'metode_pembayaran' => $channel,
                'tempat_bayar' => $channel,
                'no_rekening' => $email,
                'url_logo' => null,
            ]);
        }

        // Anda bisa menambahkan logika lain untuk update status order/penjualan di sini

        return response()->json(['success' => true]);
    }
}
