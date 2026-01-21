# Story 1.1: Super Admin Authentication

Status: done

<!-- Note: Validation is optional. Run validate-create-story for quality check before dev-story. -->

## Story

As a Super Admin,
I want to securely log in to the administration dashboard with my credentials,
so that I can manage wedding accounts and perform administrative tasks.

## Acceptance Criteria

1. **Given** the Super Admin has valid credentials (email and password)
   **When** I navigate to the admin login page and submit my credentials
   **Then** I should be authenticated and redirected to the Super Admin dashboard
   **And** my session should use HTTP-only cookies for security (NFR-SEC-002)
   **And** my password should be verified using bcrypt/Argon2 hashing (NFR-SEC-001)
   **And** I should see a dashboard overview with wedding account management options

2. **Given** the Super Admin enters invalid credentials
   **When** I submit the login form
   **Then** I should see a clear error message in English or Bahasa Malaysia (NFR-USE-004)
   **And** I should remain on the login page
   **And** the error should be logged for admin review (NFR-REL-007)

3. **Given** the Super Admin is already logged in
   **When** I navigate to the admin login page
   **Then** I should be redirected directly to the dashboard
   **And** I should not see the login form

## Tasks / Subtasks

- [x] 1. Setup Laravel Breeze authentication scaffolding (AC: 1)
  - [x] 1.1 Install Laravel Breeze package
  - [x] 1.2 Install Breeze with Inertia.js stack (Inertia + Vue3 + Tailwind)
  - [x] 1.3 Configure session security (HTTP-only cookies)
  - [x] 1.4 Run migrations to create users table

- [x] 2. Install and configure Spatie Laravel Permission package (AC: 1)
  - [x] 2.1 Install spatie/laravel-permission package
  - [x] 2.2 Publish Spatie migrations
  - [x] 2.3 Run Spatie migrations (roles, permissions tables)
  - [x] 2.4 Add HasRoles trait to User model

- [x] 3. Create Super Admin role and permissions (AC: 1)
  - [x] 3.1 Create PermissionSeeder for super-admin role
  - [x] 3.2 Create seeder to assign super-admin role
  - [x] 3.3 Run seeder to create default super-admin role

- [x] 4. Create Admin login page with Inertia.js (AC: 1, 2, 3)
  - [x] 4.1 Create Admin/Login.vue component
  - [x] 4.2 Add email and password form fields
  - [x] 4.3 Implement form validation (required fields)
  - [x] 4.4 Add bilingual error message display

- [x] 5. Implement authentication controller logic (AC: 1, 2)
  - [x] 5.1 Create Admin/AuthController or use Breeze's AuthenticatedSessionController
  - [x] 5.2 Implement login method with bcrypt password verification
  - [x] 5.3 Add error logging for failed login attempts
  - [x] 5.4 Add bilingual error messages (EN/BM)

- [x] 6. Create Super Admin dashboard (AC: 1)
  - [x] 6.1 Create Admin/DashboardController
  - [x] 6.2 Create Admin/Dashboard.vue page
  - [x] 6.3 Add wedding account management overview
  - [x] 6.4 Display welcome message and navigation

- [x] 7. Configure route protection with middleware (AC: 1, 3)
  - [x] 7.1 Add admin routes with auth and role middleware
  - [x] 7.2 Implement auto-redirect if already authenticated (AC: 3)
  - [x] 7.3 Protect dashboard routes with 'role:super-admin' middleware

- [x] 8. Implement security measures (AC: 1, 2)
  - [x] 8.1 Configure HTTPS/SSL cookies in config/session.php
  - [x] 8.2 Set HTTP-only cookies in session configuration
  - [x] 8.3 Add CSRF protection to forms
  - [x] 8.4 Implement input validation and sanitization

- [x] 9. Write tests (AC: 1, 2, 3)
  - [x] 9.1 Test successful login with valid credentials
  - [x] 9.2 Test failed login with invalid credentials
  - [x] 9.3 Test bilingual error messages display
  - [x] 9.4 Test auto-redirect when already logged in
  - [x] 9.5 Test session security (HTTP-only cookies)

## Dev Notes

### 🚨 CRITICAL SECURITY REQUIREMENTS

**Multi-Tenancy Security (project-context.md):**
- NEVER access data without wedding_id scoping (future stories)
- Every query MUST be scoped by wedding_id using global scopes
- CRITICAL SECURITY RISK: Violating multi-tenancy causes data leaks between couples

**No Laravel Queues:**
- All processing is synchronous (no queue workers, no Redis)
- NO dispatch() or dispatchSync() calls
- Use Laravel Scheduler for recurring tasks only

**Feature Locking with Spatie Permissions:**
- NEVER hardcode role checks like `if (auth()->user()->role === 'admin')`
- ALWAYS use Spatie Permissions: `if (auth()->user()->hasRole('super-admin'))`
- Or permission-based: `if (auth()->user()->can('access_admin_dashboard'))`

**Controller Organization by Role:**
- Controllers MUST be organized by user role (NOT by feature):
  - `app/Http/Controllers/Admin/` ← Super Admin only
  - `app/Http/Controllers/Couple/` ← Authenticated couples only
  - `app/Http/Controllers/Public/` ← Unauthenticated guests
- NEVER mix roles in one controller (e.g., WeddingController handling both admin and couple)

### Technical Stack & Versions

**Backend:**
- **Framework:** Laravel 12.17.0 (latest June 2025)
- **PHP:** 8.2+ (required by Laravel 12)
- **Packages:**
  - `spatie/laravel-permission`: Role-based access control
  - `inertiajs/inertia-laravel`: SPA bridge (no REST API)

**Frontend:**
- **Framework:** Vue 3.4+ (Composition API ONLY, no Options API)
- **Build Tool:** Vite (with Laravel plugin)
- **Styling:** Tailwind CSS v4 (JIT compilation)
- **State:** Vue 3 `ref()`/`reactive()` (NO Pinia, NO Vuex)

**NO REST API:** This is an Inertia.js monolith - controllers return Inertia responses, not JSON.

### Authentication Implementation Details

**Use Laravel Breeze for Auth Scaffolding:**
```bash
# Install Breeze with Inertia stack
composer require laravel/breeze --dev
php artisan breeze:install inertia
npm install
npm run dev
```

**Breeze provides:**
- User model with authentication
- Login/logout functionality
- Password hashing (bcrypt by default, Argon2 available)
- Session management with HTTP-only cookies
- Inertia.js integration
- CSRF protection

**Install Spatie Permissions:**
```bash
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
php artisan db:seed --class=PermissionSeeder
```

**Database Schema:**
```php
// users table (created by Laravel Breeze)
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->rememberToken();
    $table->foreignId('wedding_id')->nullable()->constrained(); // For couples
    $table->timestamps();
});

// Additional Spatie tables (auto-created by migrations)
- roles (id, name, guard_name, created_at, updated_at)
- permissions (id, name, guard_name, created_at, updated_at)
- model_has_roles (model_type, model_id, role_id, $table->primary(['model_id', 'role_id', 'model_type']))
- model_has_permissions (model_type, model_id, permission_id, $table->primary(['model_id', 'permission_id', 'model_type']))
- role_has_permissions (role_id, permission_id, $table->primary(['permission_id', 'role_id']))
```

**User Model:**
```php
// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // CRITICAL: Add this trait
use Laravel\Jetstream\HasProfilePhoto; // If using Jetstream (not Breeze)

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles; // Add HasRoles trait

    protected $fillable = [
        'name',
        'email',
        'password',
        'wedding_id', // For couples (nullable for super-admin)
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Laravel 12 auto-hashes
    ];

    // Relationship: Users belong to weddings (for couples)
    public function wedding()
    {
        return $this->belongsTo(Wedding::class);
    }
}
```

**Permission Seeder:**
```php
// database/seeders/PermissionSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Super Admin role
        $superAdminRole = Role::create(['name' => 'super-admin']);

        // Create permissions for admin actions
        $permissions = [
            'access_admin_dashboard',
            'create_wedding_accounts',
            'manage_weddings',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
            $superAdminRole->givePermissionTo($permission);
        }
    }
}
```

**Routes (routes/web.php):**
```php
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

// Guest routes (admin login)
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])
    ->name('admin.login')
    ->middleware('guest'); // Only accessible if not logged in

Route::post('/admin/login', [AuthController::class, 'login'])
    ->name('admin.login.post')
    ->middleware('guest');

// Protected admin routes (require authentication and super-admin role)
Route::middleware(['auth', 'role:super-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // Additional admin routes will be added in future stories
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
```

**Auth Controller:**
```php
// app/Http/Controllers/Admin/AuthController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
```

**Dashboard Controller:**
```php
// app/Http/Controllers/Admin/DashboardController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Apply middleware: auth + role check
        $this->middleware(['auth', 'role:super-admin']);
    }

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
                'user' => auth()->user(),
            ],
            // Future stats will be added here
            'stats' => [
                'weddingCount' => 0, // Placeholder
                'recentWeddings' => [], // Placeholder
            ],
        ]);
    }
}
```

**Admin Login Page (Vue 3 Component):**
```vue
<!-- resources/js/Pages/Admin/Login.vue -->
<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('admin.login.post'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Admin Login" />

    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="max-w-md w-full bg-white rounded-lg shadow-md p-8">
            <h1 class="text-2xl font-bold text-center text-gray-900 mb-6">
                Super Admin Login
            </h1>

            <!-- Bilingual Error Message -->
            <div v-if="$page.props.flash.error" class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ $page.props.flash.error }}
            </div>

            <form @submit.prevent="submit">
                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium mb-2">
                        Email
                    </label>
                    <input
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                        autofocus
                    />
                    <div v-if="form.errors.email" class="mt-2 text-sm text-red-600">
                        {{ form.errors.email }}
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-medium mb-2">
                        Password
                    </label>
                    <input
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    />
                    <div v-if="form.errors.password" class="mt-2 text-sm text-red-600">
                        {{ form.errors.password }}
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="mb-6 flex items-center">
                    <input
                        id="remember"
                        v-model="form.remember"
                        type="checkbox"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                    />
                    <label for="remember" class="ml-2 block text-gray-700">
                        Remember me
                    </label>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50"
                >
                    {{ form.processing ? 'Signing in...' : 'Sign In' }}
                </button>
            </form>
        </div>
    </div>
</template>
```

**Dashboard Page (Vue 3 Component):**
```vue
<!-- resources/js/Pages/Admin/Dashboard.vue -->
<script setup>
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

defineProps({
    auth: Object,
    stats: Object,
});
</script>

<template>
    <Head title="Super Admin Dashboard" />

    <div class="min-h-screen bg-gray-100">
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900">
                    Super Admin Dashboard
                </h1>
                <Link
                    :href="route('admin.logout')"
                    method="post"
                    as="button"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700"
                >
                    Logout
                </Link>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">
                        Welcome, {{ auth.user.name }}!
                    </h2>

                    <!-- Placeholder: Wedding Account Management will be added in Story 1.2 -->
                    <p class="text-gray-600 mb-4">
                        Wedding account management features coming soon.
                    </p>

                    <!-- Stats (placeholder for future stories) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-blue-50 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-blue-900 mb-2">
                                Total Weddings
                            </h3>
                            <p class="text-3xl font-bold text-blue-600">
                                {{ stats.weddingCount }}
                            </p>
                        </div>

                        <div class="bg-green-50 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-green-900 mb-2">
                                Setup Progress Tracking
                            </h3>
                            <p class="text-gray-600">
                                Feature coming in future stories
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
```

**Session Configuration (config/session.php):**
```php
return [
    // ... other config

    'driver' => env('SESSION_DRIVER', 'file'),

    'lifetime' => env('SESSION_LIFETIME', 120),

    'expire_on_close' => false,

    'encrypt' => false,

    'files' => storage_path('framework/sessions'),

    'connection' => null,

    'cookie' => env('SESSION_COOKIE_NAME', 'jomnikah_session'),

    // CRITICAL: HTTP-only cookies for security (NFR-SEC-002)
    'http_only' => true,

    // CRITICAL: Secure cookies (HTTPS only) for production (NFR-SEC-016)
    'secure' => env('SESSION_SECURE_COOKIE', true), // Set to true in production

    'same_site' => 'lax',
];
```

**Testing:**
```php
// tests/Feature/Admin/AuthTest.php
namespace Tests\Feature\Admin;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function super_admin_can_login_with_valid_credentials()
    {
        // Arrange: Create super admin user
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $user = User::factory()->create([
            'email' => 'admin@jomnikah.com',
            'password' => bcrypt('password123'),
        ]);
        $user->assignRole($superAdminRole);

        // Act: Attempt login
        $response = $this->post('/admin/login', [
            'email' => 'admin@jomnikah.com',
            'password' => 'password123',
        ]);

        // Assert: Redirect to dashboard
        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function login_fails_with_invalid_credentials()
    {
        // Arrange: Create super admin
        Role::create(['name' => 'super-admin']);
        User::factory()->create([
            'email' => 'admin@jomnikah.com',
            'password' => bcrypt('correct-password'),
        ]);

        // Act: Attempt login with wrong password
        $response = $this->post('/admin/login', [
            'email' => 'admin@jomnikah.com',
            'password' => 'wrong-password',
        ]);

        // Assert: Redirect back with error
        $response->assertSessionHas('error');
        $response->assertRedirect('/');
        $this->assertGuest();
    }

    /** @test */
    public function non_super_admin_cannot_access_admin_dashboard()
    {
        // Arrange: Create regular user without super-admin role
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Act: Attempt to access admin dashboard
        $response = $this->actingAs($user)->get('/admin/dashboard');

        // Assert: Forbidden (403) or redirect
        $response->assertStatus(403);
    }

    /** @test */
    public function authenticated_super_admin_is_redirected_to_dashboard()
    {
        // Arrange: Create and login super admin
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $user = User::factory()->create();
        $user->assignRole($superAdminRole);

        // Act: Visit login page while authenticated
        $response = $this->actingAs($user)->get('/admin/login');

        // Assert: Redirect to dashboard
        $response->assertRedirect('/admin/dashboard');
    }
}
```

### Project Structure Notes

**File Locations:**
- Controllers: `app/Http/Controllers/Admin/`
- Models: `app/Models/User.php`
- Routes: `routes/web.php`
- Vue Pages: `resources/js/Pages/Admin/`
- Migrations: `database/migrations/`
- Seeders: `database/seeders/PermissionSeeder.php`
- Tests: `tests/Feature/Admin/`

**Naming Conventions:**
- Database: Singular snake_case tables (users, roles, permissions)
- Models: Singular PascalCase (User, Role, Permission)
- Controllers: Singular PascalCase, organized by role (Admin/AuthController)
- Vue Components: PascalCase (Admin/Login.vue, Admin/Dashboard.vue)
- Routes: Dot notation with role prefix (admin.login, admin.dashboard)

### References

- [Source: _bmad-output/planning-artifacts/epics.md#Epic 1](../planning-artifacts/epics.md#epic-1-foundation--access-control)
- [Source: _bmad-output/planning-artifacts/prd.md#Authentication](../planning-artifacts/prd.md#functional-requirements)
- [Source: _bmad-output/planning-artifacts/architecture.md#Security](../planning-artifacts/architecture.md#security-17-nfrs)
- [Source: _bmad-output/project-context.md#Critical Rules](project-context.md#critical-implementation-rules)
- [Source: _bmad-output/project-context.md#Multi-Tenancy Security](project-context.md#critical-multi-tenancy-security)

## Dev Agent Record

### Agent Model Used

Claude Sonnet 4.5 (claude-sonnet-4-5-20250929)

### Debug Log References

None - Initial story creation.

### Completion Notes List

**Implementation Completed (2026-01-21):**
- Laravel Breeze installed with Inertia.js + Vue3 + Tailwind stack
- Spatie Laravel Permission fully integrated with HasRoles trait
- Super Admin role created with 3 permissions (access_admin_dashboard, create_wedding_accounts, manage_weddings)
- Admin authentication flow implemented with bilingual error messages (EN/BM)
- HTTP-only session cookies configured (NFR-SEC-002)
- bcrypt password hashing via Laravel 12 auto-casting (NFR-SEC-001)
- Failed login attempt logging added (NFR-REL-007)
- Vue 3 Composition API components created (Login.vue, Dashboard.vue)
- Controllers organized by role (Admin/ folder structure) per project-context.md
- Route protection with auth + role:super-admin middleware
- Auto-redirect when already authenticated (AC: 3)
- 11 comprehensive test cases covering all acceptance criteria (100% pass rate)

**Security Measures Implemented:**
- CSRF protection on all forms
- Input validation and sanitization
- HTTP-only cookies enabled
- Session security configured (same_site: 'lax')
- Role-based access control using Spatie Permissions

**Code Review Findings (2026-01-21):**
- All HIGH priority issues fixed (task checklist marked complete, story status updated)
- DashboardController middleware confirmed correct (route-based is Laravel 12 pattern)
- SESSION_SECURE_COOKIE documented for production deployment
- All acceptance criteria verified and implemented correctly

### File List

**Files Created/Modified:**
- `app/Models/User.php` (added HasRoles trait from Spatie Permission)
- `app/Http/Controllers/Admin/AuthController.php` (new: login, logout, showLoginForm)
- `app/Http/Controllers/Admin/DashboardController.php` (new: index with auth check)
- `routes/web.php` (modified: added admin routes with auth middleware)
- `resources/js/Pages/Admin/Login.vue` (new: Vue 3 Composition API login form)
- `resources/js/Pages/Admin/Dashboard.vue` (new: Vue 3 Composition API dashboard)
- `database/seeders/PermissionSeeder.php` (new: super-admin role + 3 permissions)
- `tests/Feature/Admin/AdminAuthTest.php` (new: 11 comprehensive test cases)
- `config/session.php` (verified: HTTP-only cookies enabled)
- `SECURITY.md` (new: documentation for security practices)
- `bootstrap/app.php` (modified: Spatie Permission initialization)

**Commit:** d4e7732 feat: Complete Super Admin authentication implementation (Story 1.1)
