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
        'Line1' => 'line1',
        'Line2' => 'line2',
        'Line3' => 'line3',
        'Line4' => 'line4',
        'Line5' => 'line5',
        'Line7' => 'line7',
        'Line8a' => 'line8a',
        'Line8b' => 'line8b',
        'Line10' => 'line10',
        'Line11' => 'line11',
        'Line12' => 'line12',
        'Line13' => 'line13',
        'Line14' => 'line14',
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
        if ($role && isset($this->roleLines[$role])) {
            $expectedLine = $this->roleLines[$role];
            $requestedLine = $request->route('line');

            // Redirect if the requested line does not match the user's role
            if ($requestedLine !== $expectedLine) {
                return redirect()->route('pjl.line.dashboard', ['line' => $expectedLine]);
            }
        }

        return $next($request);
    }
}