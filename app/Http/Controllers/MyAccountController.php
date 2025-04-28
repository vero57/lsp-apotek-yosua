<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyAccountController extends Controller
{
    public function index(Request $request)
    {
        // Bisa tambahkan logic lain jika perlu
        return view('fe.my_account');
    }
}
