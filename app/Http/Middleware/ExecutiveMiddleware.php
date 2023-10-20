<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ExecutiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/');
        }
        
        if (Auth::user()->role == 'executive') {
            return $next($request);
        }

        if (Auth::user()->role == 'supper-admin') {
            return redirect()->route('superAdmin.dashboard');
        } elseif (Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->role == 'executive') {
            return redirect()->route('executive.dashboard');
        } elseif (Auth::user()->role == 'user') {
            return redirect()->route('surveyor.dashboard');
        }

        abort(403, 'Unauthorized');
    }
}
