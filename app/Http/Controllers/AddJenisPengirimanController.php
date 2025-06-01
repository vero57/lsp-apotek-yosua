<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisPengiriman;

class AddJenisPengirimanController extends Controller
{
    // Tampilkan form tambah jenis pengiriman
    public function create()
    {
        return view('be.pages.addjenispengiriman');
    }

    // Simpan data jenis pengiriman
    public function store(Request $request)
    {
        $request->validate([
            'jenis_kirim' => 'required|string|max:255',
            'nama_ekspedisi' => 'required|string|max:255',
            'logo_ekspedisi' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['jenis_kirim', 'nama_ekspedisi']);

        if ($request->hasFile('logo_ekspedisi')) {
            $file = $request->file('logo_ekspedisi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('logo_ekspedisi', $filename, 'public');
            $data['logo_ekspedisi'] = $path;
        }

        JenisPengiriman::create($data);

        return redirect()->route('be.admin.jenispengiriman')->with('success', 'Jenis Pengiriman berhasil ditambahkan.');
    }

    // Hapus data jenis pengiriman
    public function destroy($id)
    {
        $jenis = \App\Models\JenisPengiriman::findOrFail($id);
        $jenis->delete();
        return redirect()->route('be.admin.jenispengiriman')->with('success', 'Jenis Pengiriman berhasil dihapus.');
    }
}
