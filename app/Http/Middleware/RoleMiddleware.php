<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role_id === 0 && in_array('customer', $request->segments())) {
            return redirect('/')->withErrors(['fail' => 'You do not have permission to access this page.']);
        }

        if (Auth::user()->role_id === 1 && in_array('merchant', $request->segments())) {
            return redirect('/')->withErrors(['fail' => 'You do not have permission to access this page.']);
        }

        return $next($request);
    }
}
