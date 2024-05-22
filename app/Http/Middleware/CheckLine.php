<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckLine
{
    /**
     * List of roles and their corresponding routes.
     *
     * @var array
     */
    protected $roleRoutes = [
        'Line1' => 'Line1',
        'Line2' => 'Line2',
        'Line3' => 'Line3',
        'Line4' => 'Line4',
        'Line5' => 'Line5',
        'Line7' => 'Line7',
        'Line8a' => 'Line8a',
        'Line8b' => 'Line8b',
        'Line10' => 'Line10',
        'Line11' => 'Line11',
        'Line12' => 'Line12',
        'Line13' => 'Line13',
        'Line14' => 'Line14',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Assume you have a method to get the user role
        $user = Auth::user();
        $role = $user ? $user->role : null;

        // Check if the role exists in the roleRoutes array
        if ($role && isset($this->roleRoutes[$role])) {
            $route = $this->roleRoutes[$role];
            // Redirect if the request is not for the correct route
            if (!$request->is($route)) {
                return redirect($route);
            }
        }

        return $next($request);
    }
}
