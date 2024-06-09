<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

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
        'Line14' => 'line14'
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

        // Get the requested line from the route
        $requestedLine = ucfirst(strtolower($request->route('line'))); // Ubah huruf pertama menjadi besar

        // Check if the requested line exists in the roleRoutes array
        if (!array_key_exists($requestedLine, $this->roleRoutes)) {
            // If the requested line does not exist, return a 404 response
            abort(404, 'Line not found');
        }

        // If the user is authenticated, check their role
        if ($user) {
            $role = $user->role;

            // Ubah huruf pertama menjadi besar hanya jika role dimulai dengan "line"
            if (stripos($role, 'line') === 0) {
                $role = ucfirst(strtolower($role));
            }

            // Check if the role exists in the roleRoutes array
            if (isset($this->roleRoutes[$role])) {
                $expectedLine = $this->roleRoutes[$role];

                // Redirect if the requested line does not match the user's role
                if ($requestedLine !== $expectedLine) {
                    return redirect()->route('pjl.line.dashboard', ['line' => $expectedLine]);
                }
            } else {
                // If the role does not exist in the roleRoutes array, return a 403 response
                abort(403, 'Unauthorized access');
            }
        } else {
            // If the user is not authenticated, return a 403 response
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
