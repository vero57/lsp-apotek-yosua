<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;

class PenjualanController extends Controller
{
    public function index()
    {
        // Ambil semua data penjualan beserta relasi yang dibutuhkan
        $penjualan = Penjualan::with([
            'metode_bayar',    // relasi ke metode pembayaran
            'jenis_kirim',     // relasi ke jenis pengiriman
            'pelanggan'        // relasi ke pelanggan
        ])->get();

        return view('be.pages.penjualan', compact('penjualan'));
    }
}
