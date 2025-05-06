<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('jenisObat')->latest()->take(3)->get();
        return view('fe.index', compact('products'));
    }
}
