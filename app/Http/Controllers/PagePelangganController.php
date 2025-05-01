<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagePelangganController extends Controller
{
    public function index(Request $request)
    {
        $query = \DB::table('pelanggan');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_pelanggan', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }

        $pelanggan = $query->get();
        return view('be.pages.pelanggan', compact('pelanggan'));
    }
}
