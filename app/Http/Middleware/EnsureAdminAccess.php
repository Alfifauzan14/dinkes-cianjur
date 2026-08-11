<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check() || auth()->user()->is_active === false || ! auth()->user()->is_admin) {
            abort(403, 'Akses ditolak. Halaman ini khusus untuk admin aktif.');
        }

        return $next($request);
    }
}
