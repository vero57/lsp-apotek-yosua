<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Distributor;

class DistributorController extends Controller
{
    public function index()
    {
        $distributors = DB::table('distributor')->get();
        return view('be.pages.distributor', compact('distributors'));
    }

    public function destroy($id)
    {
        Distributor::destroy($id);
        return redirect()->route('be.admin.distributor')->with('success', 'Distributor berhasil dihapus');
    }
}
