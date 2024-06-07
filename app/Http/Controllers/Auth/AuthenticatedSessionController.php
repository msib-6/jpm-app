<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
    
        $request->session()->regenerate();
    
        // Determine the user's role
        $user = Auth::user();
        $role = strtolower($user->role);
    
        // Log the user's role
        \Log::info('User role: ' . $role);
    
        $lineRoles = [
            'line1', 'line2', 'line3', 'line4', 'line5',
            'line7', 'line8a', 'line8b', 'line10', 'line11',
            'line12', 'line13', 'line14'
        ];
    
        // Log the line roles
        \Log::info('Line roles: ' . implode(', ', $lineRoles));
    
        if (in_array($role, $lineRoles)) {
            \Log::info('Redirecting to pjl.line.dashboard with line: ' . $role);
            return redirect()->route('pjl.line.dashboard', ['line' => $role]);
        } else {
            \Log::info('Role not in line roles');
        }
    
        // Redirect to the appropriate dashboard based on the user's role
        switch ($role) {
            case 'admin':
                \Log::info('Redirecting to /admin');
                return redirect('/admin');
            case 'manager':
                \Log::info('Redirecting to /manager/dashboard');
                return redirect('/manager/dashboard');
            default:
                \Log::info('Redirecting to home');
                return redirect(RouteServiceProvider::HOME);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function adminOnlyMethod()
    {
        $this->checkRole('admin');
        // Logic for admin only
    }

    /**
     * Example method that requires manager role.
     */
    public function managerOnlyMethod()
    {
        $this->checkRole('manager');
        // Logic for manager only
    }
    private function checkLineRole($line)
    {
        $user = Auth::user();
        if (strtolower($user->role) !== $line) {
            abort(403, 'Unauthorized action.');
        }
    }
}

