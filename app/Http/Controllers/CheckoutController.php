<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = [];
        $cartTotal = 0;
        if (session('user_id')) {
            $cartItems = \App\Models\Keranjang::with('obat')
                ->where('id_pelanggan', session('user_id'))
                ->get();
            $cartTotal = $cartItems->sum('subtotal');
        }
        return view('fe.checkout', compact('cartItems', 'cartTotal'));
    }
}
