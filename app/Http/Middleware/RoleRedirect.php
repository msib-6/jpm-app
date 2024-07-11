<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        // Redirect based on user role
        if ($user->hasRole('pjl')) {
            return redirect('/pjl/' . $user->line . '/dashboard');
        } elseif ($user->hasRole('manager')) {
            return redirect('/manager/dashboard');
        } elseif ($user->hasRole('admin')) {
            return redirect('/admin/dashboard');
        } elseif ($user->hasRole('storage')) {
            return redirect('/logistik/dashboard');
        }

        return redirect(RouteServiceProvider::HOME);
    }
}