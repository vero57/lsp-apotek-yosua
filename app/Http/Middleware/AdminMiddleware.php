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
        return $next($request);
    }
}
