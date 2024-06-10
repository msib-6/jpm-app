<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                $role = ucfirst(strtolower($user->role)); // Ubah huruf pertama menjadi besar

                $lineRoles = [
                    'Line1', 'Line2', 'Line3', 'Line4', 'Line5',
                    'Line7', 'Line8a', 'Line8b', 'Line10', 'Line11',
                    'Line12', 'Line13', 'Line14'
                ];

                if (in_array($role, $lineRoles)) {
                    return redirect()->route('pjl.line.dashboard', ['line' => $role]);
                }

                // Redirect to the appropriate dashboard based on the user's role
                switch ($role) {
                    case 'Admin':
                        return redirect('/admin');
                    case 'Manager':
                        return redirect('/manager/dashboard');
                    default:
                        return redirect('/dashboard'); // Ubah ini ke halaman dashboard yang sesuai
                }
            }
        }

        return $next($request);
    }
}

