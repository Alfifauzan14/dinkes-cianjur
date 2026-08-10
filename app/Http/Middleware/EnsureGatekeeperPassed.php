<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureGatekeeperPassed
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Allow bypass in testing environment unless explicitly testing gatekeeper session
        if (app()->environment('testing') && ! $request->hasHeader('X-Test-Gatekeeper')) {
            return $next($request);
        }

        // Enforce gatekeeper check on all admin routes
        if ($request->is('admin*') && ! $request->session()->get('gatekeeper_passed')) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akses terlarang. Anda harus melewati Verifikasi Gerbang Lapis 1 terlebih dahulu.',
                ], 403);
            }

            return redirect()->route('login')->with('error', 'Silakan selesaikan verifikasi Gerbang Lapis 1 terlebih dahulu.');
        }

        return $next($request);
    }
}
