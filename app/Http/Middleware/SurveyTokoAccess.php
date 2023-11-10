<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SurveyTokoAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('toko')->check()) {
            return $next($request);
        } elseif (Auth::check()) {
            if (Auth::user()->role == 'supper-admin') {
                return redirect()->route('superAdmin.dashboard');
            } elseif (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role == 'executive') {
                return redirect()->route('executive.dashboard');
            } elseif (Auth::user()->role == 'user') {
                return redirect()->route('surveyor.dashboard');
            }
        } else {
            return redirect()->route('loginToko');
        }

        abort(403, 'Unauthorized');
    }
}
