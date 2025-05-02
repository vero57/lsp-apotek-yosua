<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distributor;

class EditDistributorController extends Controller
{
    public function edit($id)
    {
        $distributor = Distributor::findOrFail($id);
        return view('be.pages.editdistributor', compact('distributor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_distributor' => 'required|string|max:255',
            'telepon' => 'required|string|max:30',
            'alamat' => 'required|string|max:255',
        ]);

        $distributor = Distributor::findOrFail($id);
        $distributor->update([
            'nama_distributor' => $request->nama_distributor,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('be.admin.distributor')->with('success', 'Distributor berhasil diupdate');
    }
}
