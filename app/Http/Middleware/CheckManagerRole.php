<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckManagerRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user has the "manager" role
        if ($request->user() && $request->user()->role === 'Manager') {
            // User has manager role, allow access to the route
            return $next($request);
        }

         // User does not have manager role, return a response with a popup message and redirect to /login
         return redirect()->route('login')->with('error', 'You do not have permission to access this page.');
    }
}
