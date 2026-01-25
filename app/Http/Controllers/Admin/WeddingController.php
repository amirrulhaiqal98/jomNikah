<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWeddingRequest;
use App\Http\Requests\UpdateWeddingRequest;
use App\Models\User;
use App\Models\Wedding;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

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
                'wish_present_enabled' => $request->boolean('wish_present_enabled', false), // Story 1.4 - Use checkbox
                'digital_ang_pow_enabled' => $request->boolean('digital_ang_pow_enabled', false), // Story 1.4 - Use checkbox
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

            // Story 1.4 - Sync premium feature permissions
            $this->syncPremiumPermissions($user, $wedding);

            DB::commit();

            // AC: 2 - Log account creation action
            Log::info('Wedding account created', [
                'wedding_id' => $wedding->id,
                'user_id' => $user->id,
                'email' => $user->email,
                'phone' => $request->phone,
                'package_tier' => $wedding->package_tier, // AC: 4 - Log package tier
                'wish_present_enabled' => $wedding->wish_present_enabled, // Story 1.4 - Log feature toggle
                'digital_ang_pow_enabled' => $wedding->digital_ang_pow_enabled, // Story 1.4 - Log feature toggle
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
     * Sync premium feature permissions based on feature toggles (Story 1.4)
     * CRITICAL: Permission synchronization for feature access control
     */
    protected function syncPremiumPermissions(User $user, Wedding $wedding): void
    {
        // Ensure permissions exist in database (defensive programming)
        $wishPresentPermission = Permission::firstOrCreate(['name' => 'access_wish_present_registry']);
        $digitalAngPowPermission = Permission::firstOrCreate(['name' => 'access_digital_ang_pow']);

        // Wish Present Registry permission
        if ($wedding->wish_present_enabled) {
            if (!$user->hasPermissionTo('access_wish_present_registry')) {
                $user->givePermissionTo($wishPresentPermission);
            }
        } else {
            if ($user->hasPermissionTo('access_wish_present_registry')) {
                $user->revokePermissionTo($wishPresentPermission);
            }
        }

        // Digital Ang Pow permission
        if ($wedding->digital_ang_pow_enabled) {
            if (!$user->hasPermissionTo('access_digital_ang_pow')) {
                $user->givePermissionTo($digitalAngPowPermission);
            }
        } else {
            if ($user->hasPermissionTo('access_digital_ang_pow')) {
                $user->revokePermissionTo($digitalAngPowPermission);
            }
        }
    }

    /**
     * Display wedding account edit form (Story 1.4)
     */
    public function edit(Wedding $wedding)
    {
        $wedding->load('user'); // Eager load user relationship

        return Inertia::render('Admin/EditWedding', [
            'wedding' => $wedding,
        ]);
    }

    /**
     * Update wedding account (Story 1.4)
     */
    public function update(UpdateWeddingRequest $request, Wedding $wedding)
    {
        DB::beginTransaction();

        try {
            $wedding->update([
                'bride_name' => $request->bride_name,
                'groom_name' => $request->groom_name,
                'wish_present_enabled' => $request->boolean('wish_present_enabled', false), // Story 1.4
                'digital_ang_pow_enabled' => $request->boolean('digital_ang_pow_enabled', false), // Story 1.4
            ]);

            // Sync permissions when toggles change
            $this->syncPremiumPermissions($wedding->user, $wedding);

            DB::commit();

            Log::info('Wedding account updated', [
                'wedding_id' => $wedding->id,
                'wish_present_enabled' => $wedding->wish_present_enabled,
                'digital_ang_pow_enabled' => $wedding->digital_ang_pow_enabled,
                'updated_by' => auth()->user()->id,
            ]);

            return redirect()->route('admin.weddings.index')
                ->with('success', 'Wedding account updated successfully. / Akaun perkahwinan berjaya dikemaskini!');

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Failed to update wedding account', [
                'error' => $e->getMessage(),
                'wedding_id' => $wedding->id,
            ]);

            return back()
                ->with('error', 'Maaf, gagal mengemaskini akaun. Sila cuba lagi. / Sorry, failed to update account. Please try again.')
                ->withInput();
        }
    }

    /**
     * Display list of weddings (Story 7.1)
     */
    public function index()
    {
        $weddings = Wedding::with('user')->get(); // Eager load user relationship

        return Inertia::render('Admin/Weddings', [
            'weddings' => $weddings,
        ]);
    }
}
