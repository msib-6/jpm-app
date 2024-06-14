<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedWithRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            $role = $user->role;

            // Ubah huruf pertama menjadi besar hanya jika role dimulai dengan "line"
            if (stripos($role, 'line') === 0) {
                $role = ucfirst(strtolower($role));
            }

            $lineRoles = [
                'Line1', 'Line2', 'Line3', 'Line4', 'Line5',
                'Line7', 'Line8a', 'Line8b', 'Line10', 'Line11',
                'Line12', 'Line13', 'Line14'
            ];

            if (in_array($role, $lineRoles)) {
                return redirect()->route('pjl.line.dashboard', ['line' => $role]);
            }

            switch ($role) {
                case 'Admin':
                    return redirect('/admin');
                case 'Manager':
                    return redirect('/manager/dashboard');
                default:
                    return redirect('/home');
            }
        }

        return $next($request);
    }
}