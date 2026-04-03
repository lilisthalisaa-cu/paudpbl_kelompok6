<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ParentMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // cek session login parent
        if (!session()->has('parent_id')) {
            return redirect()->route('parent.login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        return $next($request);
    }
}