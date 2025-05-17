<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = \App\Models\Penjualan::with(['metodeBayar', 'pelanggan', 'jenisPengiriman'])->get();

        // Ambil enum status_order dari database
        $enum = [];
        // Ganti DB::select(DB::raw(...)) menjadi DB::select(...)
        $type = DB::select("SHOW COLUMNS FROM penjualan WHERE Field = 'status_order'")[0]->Type ?? '';
        if (preg_match('/^enum\((.*)\)$/', $type, $matches)) {
            $enum = array_map(function($v) {
                return trim($v, "'");
            }, explode(',', $matches[1]));
        }

        return view('be.pages.penjualan', compact('penjualan', 'enum'));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:penjualan,id',
            'status' => 'required|string'
        ]);
        $penjualan = \App\Models\Penjualan::findOrFail($request->id);
        $penjualan->status_order = $request->status;
        $penjualan->save();
        return redirect()->back();
    }

    public function cancelOrder(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:penjualan,id'
        ]);
        $penjualan = \App\Models\Penjualan::findOrFail($request->id);
        $penjualan->status_order = 'Dibatalkan Penjual';
        $penjualan->save();
        return redirect()->back();
    }
}
