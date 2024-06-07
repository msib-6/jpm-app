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
        'line1' => 'line1',
        'line2' => 'line2',
        'line3' => 'line3',
        'line4' => 'line4',
        'line5' => 'line5',
        'line7' => 'line7',
        'line8a' => 'line8a',
        'line8b' => 'line8b',
        'line10' => 'line10',
        'line11' => 'line11',
        'line12' => 'line12',
        'line13' => 'line13',
        'line14' => 'line14',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the authenticated user
        $user = Auth::user();

        // If the user is authenticated, check their role
        if ($user) {
            $role = strtolower($user->role);

            // Check if the role exists in the roleRoutes array
            if (isset($this->roleRoutes[$role])) {
                $expectedLine = $this->roleRoutes[$role];
                $requestedLine = $request->route('line');

                // Redirect if the requested line does not match the user's role
                if ($requestedLine !== $expectedLine) {
                    return redirect()->route('pjl.line.dashboard', ['line' => $expectedLine]);
                }
            }
        }

        return $next($request);
    }
}
