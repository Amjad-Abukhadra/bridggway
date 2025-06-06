<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard)
    {
        if (Auth::guard($guard)->check()) {
            return $next($request);
        }

        return redirect()->route('login')->withErrors(['auth' => 'Unauthorized access.']);
    }
}

