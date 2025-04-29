<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddJenisObat extends Controller
{
    public function create()
    {
        return view('be.pages.addjenisobat');
    }
}
