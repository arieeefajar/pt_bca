<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class NonSurveyorAccess
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

        if (Auth::user()->role !== 'user') {
            if ($request != 'super-admin-dashboard' || $request != 'admin-dashboard' || $request != 'executive-dashboard' || $request != 'surveyor-dashboard') {
                return $next($request);
            }
        }

        if (Auth::user()->role == 'user') {
            return redirect()->route('surveyor.dashboard');
        }

        abort(403, 'Unauthorized');
    }
}
