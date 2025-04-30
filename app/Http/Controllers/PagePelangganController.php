<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagePelangganController extends Controller
{
    public function index()
    {
        $pelanggan = DB::table('pelanggan')->get();
        return view('be.pages.pelanggan', compact('pelanggan'));
    }
}
