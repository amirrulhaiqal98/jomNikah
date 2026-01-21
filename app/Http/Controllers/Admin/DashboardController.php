<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the Super Admin dashboard.
     * AC: 1 - Show wedding account management options
     */
    public function index()
    {
        // TODO: In future stories, fetch wedding statistics
        // $weddingCount = Wedding::count();
        // $recentWeddings = Wedding::latest()->take(5)->get();

        return Inertia::render('Admin/Dashboard', [
            'auth' => [
                'user' => Auth::user(),
            ],
            // Future stats will be added here
            'stats' => [
                'weddingCount' => 0, // Placeholder
                'recentWeddings' => [], // Placeholder
            ],
        ]);
    }
}
