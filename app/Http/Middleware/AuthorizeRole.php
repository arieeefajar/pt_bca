<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::check() && Auth::user()->role == $role) {
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
        } elseif (Auth::guard('toko')->check()) {
            return redirect()->route('survey_toko.index');
        }

        abort(403, 'Unauthorized');
    }
}
