<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek login guard web (users)
        if (!Auth::guard('web')->check()) {
            return redirect()->route('be.login');
        }

        $user = Auth::guard('web')->user();
        $path = $request->path();

        // Jika karyawan akses selain /karyawan, /karyawan/products, /karyawan/jenis-pengiriman, redirect ke karyawan.products
        if ($user && $user->jabatan === 'karyawan' && !preg_match('#^karyawan($|/products$|/jenis-pengiriman$)#', $path)) {
            return redirect()->route('be.karyawan.products');
        }

        // Jika non-karyawan akses /karyawan, redirect ke dashboard sesuai role
        if ($user && $user->jabatan !== 'karyawan' && preg_match('#^karyawan(/|$)#', $path)) {
            // Pemilik ke dashboard pemilik, apotekar ke distributor, selain itu ke admin
            if ($user->jabatan === 'pemilik') {
                return redirect()->route('be.pemilik.index');
            } elseif ($user->jabatan === 'apotekar') {
                return redirect()->route('be.apotekar.distributor');
            } else {
                return redirect()->route('be.admin.index');
            }
        }

        // Jika pemilik akses selain /pemilik, redirect ke dashboard pemilik
        if ($user && $user->jabatan === 'pemilik' && !preg_match('#^pemilik(/|$)#', $path)) {
            return redirect()->route('be.pemilik.index');
        }

        // Jika non-pemilik akses /pemilik, redirect ke dashboard sesuai role
        if ($user && $user->jabatan !== 'pemilik' && preg_match('#^pemilik(/|$)#', $path)) {
            // Apotekar ke distributor, selain itu ke admin
            if ($user->jabatan === 'apotekar') {
                return redirect()->route('be.apotekar.distributor');
            } else {
                return redirect()->route('be.admin.index');
            }
        }

        // Jika apotekar akses /admin, redirect ke /apotekar
        if ($user && $user->jabatan === 'apotekar' && preg_match('#^admin(/|$)#', $path)) {
            return redirect()->route('be.apotekar.distributor');
        }

        // Jika non-apotekar akses /apotekar, redirect ke /admin
        if ($user && $user->jabatan !== 'apotekar' && preg_match('#^apotekar(/|$)#', $path)) {
            return redirect()->route('be.admin.index');
        }

        // Kasir hanya boleh akses /kasir (produk) dan /kasir/penjualan (beserta turunannya)
        if ($user && $user->jabatan === 'kasir' && !preg_match('#^kasir($|/penjualan($|/.*))#', $path)) {
            return redirect()->route('be.kasir.products');
        }

        return $next($request);
    }
}
