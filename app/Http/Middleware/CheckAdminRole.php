<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminRole
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
        // Check if the authenticated user has the "admin" role
        if ($request->user() && $request->user()->role === 'admin') {
            // User has admin role, allow access to the route
            return $next($request);
        }

         // User does not have admin role, return a response with a popup message and redirect to /login
         return redirect()->route('login')->with('error', 'You do not have permission to access this page.');
    }
}
