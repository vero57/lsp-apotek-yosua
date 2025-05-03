<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distributor;

class AddDistributorController extends Controller
{
    public function create()
    {
        return view('be.pages.adddistributor');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_distributor' => 'required|string|max:255',
            'telepon' => 'required|string|max:30',
            'alamat' => 'required|string|max:255',
        ]);

        Distributor::create([
            'nama_distributor' => $request->nama_distributor,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
        ]);

        $user = auth('web')->user();
        $route = ($user && $user->jabatan === 'apotekar') ? 'be.apotekar.distributor' : 'be.admin.distributor';
        return redirect()->route($route)->with('success', 'Distributor berhasil ditambahkan');
    }
}
