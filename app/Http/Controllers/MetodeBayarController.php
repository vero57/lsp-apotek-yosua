<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetodeBayar;

class MetodeBayarController extends Controller
{
    public function index()
    {
        $metodeBayar = MetodeBayar::all();
        return view('be.pages.metodebayar', compact('metodeBayar'));
    }

    public function create()
    {
        return view('be.pages.metodebayar_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'metode_pembayaran' => 'required|string|max:255',
            'tempat_bayar' => 'nullable|string|max:255',
            'no_rekening' => 'nullable|string|max:255',
            'url_logo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['metode_pembayaran', 'tempat_bayar', 'no_rekening']);

        if ($request->hasFile('url_logo')) {
            $data['url_logo'] = $request->file('url_logo')->store('metode_bayar', 'public');
        }

        MetodeBayar::create($data);

        return redirect()->route('be.admin.metodebayar')->with('success', 'Metode pembayaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $metodeBayar = MetodeBayar::findOrFail($id);
        return view('be.pages.metodebayar_edit', compact('metodeBayar'));
    }

    public function update(Request $request, $id)
    {
        $metodeBayar = MetodeBayar::findOrFail($id);

        $request->validate([
            'metode_pembayaran' => 'required|string|max:255',
            'tempat_bayar' => 'nullable|string|max:255',
            'no_rekening' => 'nullable|string|max:255',
            'url_logo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['metode_pembayaran', 'tempat_bayar', 'no_rekening']);

        if ($request->hasFile('url_logo')) {
            $data['url_logo'] = $request->file('url_logo')->store('metode_bayar', 'public');
        }

        $metodeBayar->update($data);

        return redirect()->route('be.admin.metodebayar')->with('success', 'Metode pembayaran berhasil diupdate.');
    }

    public function destroy($id)
    {
        $metodeBayar = MetodeBayar::findOrFail($id);
        if ($metodeBayar->url_logo) {
            \Storage::disk('public')->delete($metodeBayar->url_logo);
        }
        $metodeBayar->delete();

        return redirect()->route('be.admin.metodebayar')->with('success', 'Metode pembayaran berhasil dihapus.');
    }
}
