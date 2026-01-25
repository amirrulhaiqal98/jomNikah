<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWeddingRequest;
use App\Models\User;
use App\Models\Wedding;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class WeddingController extends Controller
{
    /**
     * Display wedding account creation form.
     * AC: 1 - Show form with couple names, email/phone, password fields
     *
     * Security: Middleware applied via routes (web.php)
     * - auth: User must be authenticated
     * - role:super-admin: User must have super-admin role
     */
    public function create()
    {
        return Inertia::render('Admin/CreateWedding');
    }

    /**
     * Store new wedding account and couple user.
     * AC: 2 - Create User with 'couple' role, Wedding record, hash password
     * AC: 3 - Validate required fields, show inline errors
     * AC: 4 - Check email uniqueness
     * AC: 5 - Enable couple login with credentials
     */
    public function store(StoreWeddingRequest $request)
    {
        // AC: 2 - Wrap in database transaction for atomicity
        DB::beginTransaction();

        try {
            // Step 1: Create Wedding record first
            $wedding = Wedding::create([
                'bride_name' => $request->bride_name,
                'groom_name' => $request->groom_name,
                'package_tier' => $request->package_tier ?? 'standard', // AC: 2, 3 - Use form input with fallback
                'wish_present_enabled' => false, // Default (Story 1.4 will add toggles)
                'digital_ang_pow_enabled' => false, // Default (Story 1.4 will add toggles)
                'setup_progress' => 0, // 0% complete (Story 2.6 will track progress)
            ]);

            // Step 2: Determine password - use phone number as default if not provided
            $password = $request->filled('password') ? $request->password : $request->phone;

            // Step 3: Create User record with 'couple' role
            $user = User::create([
                'name' => "{$request->bride_name} & {$request->groom_name}",
                'email' => $request->email,
                'phone' => $request->phone, // Store phone number for contact
                'password' => $password, // Laravel 12 auto-hashes
                'wedding_id' => $wedding->id, // CRITICAL: Link user to wedding
            ]);

            // Step 3: Assign 'couple' role using Spatie Permissions
            $user->assignRole('couple');

            DB::commit();

            // AC: 2 - Log account creation action
            Log::info('Wedding account created', [
                'wedding_id' => $wedding->id,
                'user_id' => $user->id,
                'email' => $user->email,
                'phone' => $request->phone,
                'package_tier' => $wedding->package_tier, // AC: 4 - Log package tier
                'password_was_phone' => !$request->filled('password'), // Track if phone used as password
                'created_by' => auth()->user()->id,
            ]);

            // AC: 5 - Return to form with credentials for sharing
            // Pass created credentials via flash session to display on form
            return back()
                ->with('success', 'Wedding account created successfully! / Akaun perkahwinan berjaya dicipta!')
                ->with('couple_credentials', [
                    'email' => $user->email,
                    'phone' => $request->phone,
                    'password' => $password, // Actual password used (phone or custom)
                    'password_source' => $request->filled('password') ? 'custom' : 'phone', // For display info
                    'bride_name' => $request->bride_name,
                    'groom_name' => $request->groom_name,
                ]);

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Failed to create wedding account', [
                'error' => $e->getMessage(),
                'request' => $request->all(),
            ]);

            // Bilingual error message (NFR-USE-004)
            return back()
                ->with('error', 'Maaf, gagal mencipta akaun. Sila cuba lagi. / Sorry, failed to create account. Please try again.')
                ->withInput();
        }
    }

    /**
     * Display list of weddings (for future Story 7.1)
     */
    public function index()
    {
        $weddings = Wedding::with('user')->get(); // Eager load user relationship

        return Inertia::render('Admin/Weddings', [
            'weddings' => $weddings,
        ]);
    }
}
