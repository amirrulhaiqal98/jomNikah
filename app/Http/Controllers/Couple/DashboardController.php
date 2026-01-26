<?php

namespace App\Http\Controllers\Couple;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the couple's dashboard.
     * Security: Double-check user has couple role (defense in depth)
     */
    public function index()
    {
        // Authorization: Ensure user is a couple (defense in depth beyond middleware)
        if (!Auth::user()?->hasRole('couple')) {
            abort(403, 'Unauthorized access.');
        }

        $wedding = Auth::user()->wedding;

        return Inertia::render('Couple/Dashboard', [
            'wedding' => $wedding,
            'setup_progress' => $wedding->setup_progress ?? 0,
        ]);
    }
}
