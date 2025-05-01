<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistributorController extends Controller
{
    public function index()
    {
        $distributors = DB::table('distributor')->get();
        return view('be.pages.distributor', compact('distributors'));
    }

}
