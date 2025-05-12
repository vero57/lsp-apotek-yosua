<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisPengiriman;
use Illuminate\Support\Facades\Storage;

class EditJenisPengirimanController extends Controller
{
    public function edit($id)
    {
        $jenisPengiriman = JenisPengiriman::findOrFail($id);
        return view('be.pages.editjenispengiriman', compact('jenisPengiriman'));
    }

    public function update(Request $request, $id)
    {
        $jenisPengiriman = JenisPengiriman::findOrFail($id);

        $request->validate([
            'jenis_kirim' => 'required|string|max:255',
            'nama_ekspedisi' => 'required|string|max:255',
            'logo_ekspedisi' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $jenisPengiriman->jenis_kirim = $request->jenis_kirim;
        $jenisPengiriman->nama_ekspedisi = $request->nama_ekspedisi;

        if ($request->hasFile('logo_ekspedisi')) {
            // Hapus logo lama jika ada
            if ($jenisPengiriman->logo_ekspedisi && Storage::disk('public')->exists($jenisPengiriman->logo_ekspedisi)) {
                Storage::disk('public')->delete($jenisPengiriman->logo_ekspedisi);
            }
            $file = $request->file('logo_ekspedisi');
            $path = $file->store('logo_ekspedisi', 'public');
            $jenisPengiriman->logo_ekspedisi = $path;
        }

        $jenisPengiriman->save();

        return redirect()->route('be.admin.jenispengiriman')->with('success', 'Jenis pengiriman berhasil diupdate.');
    }
}
