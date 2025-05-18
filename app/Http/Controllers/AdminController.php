<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;

class AdminController extends Controller
{
    public function index()
    {
        $penjualan_terbaru = Penjualan::with(['metodeBayar', 'pelanggan', 'jenisPengiriman'])
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        return view('be.admin.index', compact('penjualan_terbaru'));
    }
}
