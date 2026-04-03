<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek apakah sudah login
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Cek apakah role sesuai
        if (auth()->user()->role !== $role) {
            abort(403);
        }

        return $next($request);
    }
}