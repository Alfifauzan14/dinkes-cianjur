<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->get('gatekeeper_passed')) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akses terlarang. Verifikasi Gerbang Lapis 1 diperlukan.',
                ], 403);
            }

            return redirect()->route('login')->with('error', 'Silakan verifikasi Gerbang Lapis 1 terlebih dahulu.');
        }

        if (! auth()->check() || auth()->user()->is_active === false || ! auth()->user()->is_admin) {
            abort(403, 'Akses ditolak. Halaman ini khusus untuk admin aktif.');
        }

        return $next($request);
    }
}
