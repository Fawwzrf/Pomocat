<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek jika pengguna sudah login DAN adalah seorang admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Jika tidak, tolak akses
        abort(403, 'AKSES DITOLAK: ANDA BUKAN ADMIN.');
    }
}
