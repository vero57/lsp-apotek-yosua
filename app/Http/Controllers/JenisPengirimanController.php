<?php

namespace App\Http\Controllers;

use App\Models\JenisPengiriman;

class JenisPengirimanController extends Controller
{
    // Tampilkan halaman table jenis pengiriman
    public function index()
    {
        $jenisPengiriman = JenisPengiriman::all();
        return view('be.pages.jenispengiriman', compact('jenisPengiriman'));
    }
}
