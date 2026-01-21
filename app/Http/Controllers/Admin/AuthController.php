<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class AuthController extends Controller
{
    /**
     * Show the admin login form.
     * Auto-redirect if already authenticated.
     */
    public function showLoginForm(Request $request)
    {
        // AC: 3 - Auto-redirect if already logged in
        if (Auth::check() && Auth::user()->hasRole('super-admin')) {
            return redirect()->route('admin.dashboard');
        }

        return Inertia::render('Admin/Login');
    }

    /**
     * Handle admin login request.
     * AC: 1 - Authenticate and redirect
     * AC: 2 - Show bilingual error on failure
     */
    public function login(Request $request)
    {
        // Validate input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt authentication
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // CRITICAL: Check if user has super-admin role
            if (!Auth::user()->hasRole('super-admin')) {
                Auth::logout();
                return back()->with('error', 'Maaf, akses ini hanya untuk Super Admin. / Sorry, this access is for Super Admin only.');
            }

            return redirect()->intended(route('admin.dashboard'));
        }

        // AC: 2 - Log failed login attempt
        Log::warning('Failed admin login attempt', [
            'email' => $request->email,
            'ip' => $request->ip(),
        ]);

        // Bilingual error message (NFR-USE-004)
        return back()->with('error',
            'Maaf, kredensial log masuk tidak sah. / Sorry, these login credentials are invalid.'
        )->withInput();
    }

    /**
     * Handle admin logout.
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
