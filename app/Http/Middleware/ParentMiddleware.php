<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ParentMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah parent sudah login (pakai session)
        if (!session()->has('parent_id')) {
            return redirect()->route('login') // arahkan ke login utama
                ->with('error', 'Silakan login sebagai orang tua terlebih dahulu');
        }

        return $next($request);
    }
}