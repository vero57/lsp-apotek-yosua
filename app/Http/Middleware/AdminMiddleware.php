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

        // Jika apotekar akses /admin, redirect ke /apotekar
        if ($user && $user->jabatan === 'apotekar' && preg_match('#^admin(/|$)#', $path)) {
            return redirect()->route('be.apotekar.distributor');
        }

        // Jika non-apotekar akses /apotekar, redirect ke /admin
        if ($user && $user->jabatan !== 'apotekar' && preg_match('#^apotekar(/|$)#', $path)) {
            return redirect()->route('be.admin.index');
        }

        return $next($request);
    }
}
