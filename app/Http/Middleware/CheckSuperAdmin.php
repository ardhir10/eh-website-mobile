<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'Super Admin') {
            return $next($request);
        }

        // if not authenticated
        if (!auth()->check()) {
            return redirect()->route('auth.signin')->with('login', 'Unauthorized access. Only Super Admin can access this page.');
        }



        return redirect()->route('monitoring.index')->with('login', 'Unauthorized access. Only Super Admin can access this page.');
    }
} 