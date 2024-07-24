<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Audits;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

        // Regenerate the session to protect against session fixation attacks
        $request->session()->regenerate();

        // Get the authenticated user
        $user = $request->user();

        // Log the audit event using the method defined in the User model
        $user->logAudit('login', $user);

        // Determine the user's role
        $user = Auth::user();
        $role = ucfirst(strtolower($user->role)); // Ubah huruf pertama menjadi besar

        // Log the user's role
        Log::info('User role: ' . $role);

        $lineRoles = [
            'Line1', 'Line2', 'Line3', 'Line4', 'Line5',
            'Line7', 'Line8a', 'Line8b', 'Line10', 'Line11',
            'Line12', 'Line13', 'Line14'
        ];

        // Log the line roles
        Log::info('Line roles: ' . implode(', ', $lineRoles));

        if (in_array($role, $lineRoles)) {
            Log::info('Redirecting to pjl.line.dashboard with line: ' . $role);
            return redirect()->route('pjl.line.dashboard', ['line' => $role]);
        } else {
            Log::info('Role not in line roles');
        }
        // dd($logAudits);

        // Redirect to the appropriate dashboard based on the user's role
        switch ($role) {
            case 'Admin':
                Log::info('Redirecting to /admin');
                return redirect('/admin');
            case 'Manager':
                Log::info('Redirecting to /manager/dashboard');
                return redirect('/manager/dashboard');
            case 'Storage':
                Log::info('Redirecting to /logistik/dashboard');
                return redirect('/logistik/dashboard');
            default:
                Log::info('Redirecting to home');
                return redirect('/dashboard');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Get the authenticated user
        $user = $request->user();

        // Log the audit event before logging out
        if ($user) {
            $user->logAudit('logout', $user);
        }

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
    protected function checkRole($role)
    {
        $user = Auth::user();

        if ($user->role !== ucfirst(strtolower($role))) {
            // Redirect based on user role
            if (in_array($user->role, ['Line1', 'Line2', 'Line3', 'Line4', 'Line5', 'Line7', 'Line8a', 'Line8b', 'Line10', 'Line11', 'Line12', 'Line13', 'Line14'])) {
                return redirect()->route('pjl.line.dashboard', ['line' => $user->role]);
            } elseif ($user->role === 'Manager') {
                return redirect('/manager/dashboard');
            } elseif ($user->role === 'Storage') {
                return redirect('/logistik/dashboard');
            } elseif ($user->role === 'Admin') {
                return redirect('/admin');
            }
        }
    }
}
