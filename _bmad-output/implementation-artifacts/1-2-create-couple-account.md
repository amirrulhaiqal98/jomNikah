# Story 1.2: Create Couple Account

Status: done

<!-- Note: Validation is optional. Run validate-create-story for quality check before dev-story. -->

## Story

As a Super Admin,
I want to create new couple accounts with email/phone and secure password credentials,
so that couples can log in and begin setting up their wedding card.

## Acceptance Criteria

1. **Given** I am logged in as Super Admin
   **When** I navigate to the wedding account creation page
   **Then** I should see a streamlined form with fields: Couple's names, Email, Phone Number, Password (optional) (FR1)
   **And** the phone number will be used as the default password if no custom password is provided

2. **Given** I have filled in all required couple account information
   **When** I submit the account creation form
   **Then** the system should create a new User record with role 'couple'
   **And** the system should store the phone number for contact purposes
   **And** the system should use the phone number as the default password (unless custom password provided)
   **And** the system should hash the password using bcrypt/Argon2 (NFR-SEC-001)
   **And** I should see a confirmation message "Wedding account created successfully"
   **And** the form should complete within 5 minutes (NFR-USE-008)
   **And** the system should log the account creation action

3. **Given** I submit the form with missing required fields
   **When** the form validation runs
   **Then** I should see inline validation errors for missing fields
   **And** the errors should be clear and actionable (NFR-USE-005)
   **And** the form should not submit

4. **Given** I submit the form with an email/phone that already exists
   **When** the system checks for duplicates
   **Then** I should see a validation error "This email or phone is already registered"
   **And** the account should not be created

5. **Given** the account is successfully created
   **When** the creation process completes
   **Then** I should see the couple's credentials displayed (email, phone, and actual password used)
   **And** I should be able to share these credentials with the couple via WhatsApp or phone
   **And** the couple should be able to log in using those credentials (FR6)

## Tasks / Subtasks

- [x] 1. Create Admin/WeddingController with create and store methods (AC: 1, 2, 3, 4, 5)
  - [x] 1.1 Create controller in app/Http/Controllers/Admin/WeddingController.php
  - [x] 1.2 Implement create() method to display account creation form
  - [x] 1.3 Implement store() method to handle form submission and validation
  - [x] 1.4 Add auth + role:super-admin middleware to controller (applied via routes)

- [x] 2. Create wedding account creation form (AC: 1)
  - [x] 2.1 Create Admin/CreateWedding.vue page
  - [x] 2.2 Add form fields: bride_name, groom_name, email, phone (required), password (optional, defaults to phone)
  - [x] 2.3 Implement client-side validation for required fields
  - [x] 2.4 Add bilingual error message display (EN/BM)
  - [x] 2.5 Display credentials after successful creation (email, phone, actual password)

- [x] 3. Implement backend validation and account creation logic (AC: 2, 3, 4)
  - [x] 3.1 Create FormRequest validation class (StoreWeddingRequest)
  - [x] 3.2 Validate required fields (names, email, phone) and optional password
  - [x] 3.3 Check email uniqueness in users table (phone can be duplicated)
  - [x] 3.4 Use phone number as default password if custom password not provided
  - [x] 3.5 Create User record with phone and 'couple' role using Spatie Permissions
  - [x] 3.6 Hash password using Laravel 12 auto-casting
  - [x] 3.7 Create empty Wedding record linked to user (wedding_id foreign key)

- [x] 4. Add admin routes for wedding account creation (AC: 1, 2)
  - [x] 4.1 Add route to display creation form (GET /admin/weddings/create)
  - [x] 4.2 Add route to handle form submission (POST /admin/weddings)
  - [x] 4.3 Apply auth and role:super-admin middleware

- [x] 5. Implement success feedback and logging (AC: 2, 5)
  - [x] 5.1 Return back() with bilingual confirmation message and credentials in flash session
  - [x] 5.2 Log account creation action (including phone and password source) for audit trail
  - [x] 5.3 Display credentials for sharing with couple (email, phone, actual password, password source indicator)

- [x] 6. Write comprehensive tests (AC: 1, 2, 3, 4, 5)
  - [x] 6.1 Test successful account creation with valid data
  - [x] 6.2 Test validation errors for missing required fields (including phone)
  - [x] 6.3 Test duplicate email rejection
  - [x] 6.4 Test 'couple' role assignment via Spatie Permissions
  - [x] 6.5 Test password hashing (bcrypt via Laravel 12)
  - [x] 6.6 Test unauthenticated access rejection (middleware)
  - [x] 6.7 Test non-super-admin access rejection
  - [x] 6.8 Test phone number used as default password
  - [x] 6.9 Test custom password overrides phone default
  - [x] 6.10 Test couple can authenticate with phone-as-password
  - [x] 6.11 Test phone validation accepts Malaysian formats
  - [x] 6.12 Test audit logging tracks account creation with phone

## Dev Notes

### 🚨 CRITICAL SECURITY REQUIREMENTS

**Multi-Tenancy Security (project-context.md):**
- When creating Wedding record, always link to User via wedding_id foreign key
- Future stories will enforce wedding_id scoping for all data access
- CRITICAL SECURITY RISK: Every query MUST be scoped by wedding_id to prevent data leaks between couples

**No Laravel Queues:**
- All account creation is synchronous (no queue workers, no Redis)
- NO dispatch() or dispatchSync() calls
- Account creation completes immediately on form submission

**Feature Locking with Spatie Permissions:**
- NEVER hardcode role checks like `if ($user->role === 'couple')`
- ALWAYS use Spatie Permissions: `$user->hasRole('couple')` or `$user->assignRole('couple')`
- This story creates users with 'couple' role using Spatie's role system

**Controller Organization by Role:**
- Controllers MUST be organized by user role (NOT by feature):
  - `app/Http/Controllers/Admin/WeddingController.php` ← Super Admin creates couple accounts
  - DO NOT create generic WeddingController in root Controllers/ folder
- NEVER mix roles in one controller (e.g., WeddingController handling both admin and couple)

**Database Schema Requirements:**
- users table must include wedding_id foreign key (nullable for super-admin, required for couples)
- weddings table stores couple wedding data (created in this story)
- User.wedding() relationship: belongsTo(Wedding::class)
- Wedding.user() relationship: hasOne(User::class) or hasMany(User::class) if needed

### Previous Story Intelligence (Story 1.1)

**✅ Already Implemented:**
- Laravel Breeze authentication with Inertia.js + Vue3 + Tailwind
- Spatie Laravel Permission package fully integrated
- User model has HasRoles trait
- Super Admin role and permissions created
- Admin authentication flow with bilingual error messages
- HTTP-only session cookies configured
- bcrypt password hashing via Laravel 12 auto-casting
- Admin routes organized in routes/web.php with middleware
- Vue 3 Composition API components (Login.vue, Dashboard.vue)

**📁 Files Created in Story 1.1:**
- `app/Models/User.php` (HasRoles trait added)
- `app/Http/Controllers/Admin/AuthController.php` (login, logout)
- `app/Http/Controllers/Admin/DashboardController.php` (dashboard)
- `routes/web.php` (admin routes with auth middleware)
- `resources/js/Pages/Admin/Login.vue`
- `resources/js/Pages/Admin/Dashboard.vue`
- `database/seeders/PermissionSeeder.php` (super-admin role)

**🎯 Key Patterns Established:**
- Controllers organized by role in Admin/ folder
- Route naming: `admin.weddings.create`, `admin.weddings.store`
- Bilingual error messages: English and Bahasa Malaysia
- Vue 3 Composition API with `<script setup>` syntax
- Inertia.js for page rendering (no REST API)
- Form validation with Laravel FormRequest classes

**🔐 Security Measures from Story 1.1:**
- CSRF protection on all forms
- Input validation and sanitization
- HTTP-only cookies enabled
- Role-based access control using Spatie Permissions
- Session security (same_site: 'lax')

**⚠️ Important Notes for This Story:**
- Wedding record creation is NEW functionality (not in Story 1.1)
- Wedding migration may or may not exist - check and create if needed
- User.wedding_id column should exist (nullable for super-admin)
- Couple users will have wedding_id set, Super Admin will have wedding_id = null

### Technical Stack & Versions

**Backend:**
- **Framework:** Laravel 12.17.0 (latest June 2025)
- **PHP:** 8.2+ (required by Laravel 12)
- **Packages:**
  - `spatie/laravel-permission`: Role-based access control (already installed)
  - `inertiajs/inertia-laravel`: SPA bridge (no REST API)

**Frontend:**
- **Framework:** Vue 3.4+ (Composition API ONLY, no Options API)
- **Build Tool:** Vite (with Laravel plugin)
- **Styling:** Tailwind CSS v4 (JIT compilation)
- **State:** Vue 3 `ref()`/`reactive()` (NO Pinia, NO Vuex)

**NO REST API:** This is an Inertia.js monolith - controllers return Inertia responses, not JSON.

### Database Schema Requirements

**Users Table (already exists with minor additions needed):**
```php
// From Story 1.1 - already created by Laravel Breeze
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name'); // Will store "Bride Name & Groom Name"
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->rememberToken();
    $table->foreignId('wedding_id')->nullable()->constrained(); // CRITICAL: Links couple to wedding
    $table->timestamps();
});
```

**Weddings Table (CREATE IF NOT EXISTS):**
```php
// NEW TABLE - Create migration if not exists
Schema::create('weddings', function (Blueprint $table) {
    $table->id();
    $table->string('subdomain')->nullable()->unique(); // For future Story 2.2
    $table->enum('package_tier', ['standard', 'premium'])->default('standard'); // For future Story 1.3
    $table->boolean('wish_present_enabled')->default(false); // For future Story 1.4
    $table->boolean('digital_ang_pow_enabled')->default(false); // For future Story 1.4
    $table->string('bride_name')->nullable(); // For future Story 2.4
    $table->string('groom_name')->nullable(); // For future Story 2.4
    $table->dateTime('wedding_date')->nullable(); // For future Story 2.4
    $table->string('venue')->nullable(); // For future Story 2.4
    $table->string('template')->nullable(); // For future Story 2.3
    $table->unsignedInteger('setup_progress')->default(0); // For future Story 2.6
    $table->timestamps();

    // CRITICAL: Multi-tenancy - all future tables will have wedding_id foreign key
});
```

**Migration Check:**
```bash
# Check if weddings migration exists
ls database/migrations/*_create_weddings_table.php

# If not exists, create it
php artisan make:migration create_weddings_table
```

**User Model (update relationship):**
```php
// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens; // If using Sanctum (optional)

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'wedding_id', // CRITICAL: Links couple to wedding
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Laravel 12 auto-hashes
    ];

    // Relationship: Couples belong to a wedding
    public function wedding()
    {
        return $this->belongsTo(Wedding::class);
    }
}
```

**Wedding Model (CREATE):**
```php
// app/Models/Wedding.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    use HasFactory;

    protected $fillable = [
        'subdomain',
        'package_tier',
        'wish_present_enabled',
        'digital_ang_pow_enabled',
        'bride_name',
        'groom_name',
        'wedding_date',
        'venue',
        'template',
        'setup_progress',
    ];

    protected $casts = [
        'wedding_date' => 'datetime',
        'wish_present_enabled' => 'boolean',
        'digital_ang_pow_enabled' => 'boolean',
    ];

    // Relationship: Wedding has one couple user
    public function user()
    {
        return $this->hasOne(User::class); // Or hasMany if multiple users per wedding
    }
}
```

### Controller Implementation

**Admin/WeddingController.php:**
```php
// app/Http/Controllers/Admin/WeddingController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWeddingRequest;
use App\Models\User;
use App\Models\Wedding;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class WeddingController extends Controller
{
    public function __construct()
    {
        // CRITICAL: Apply middleware - auth + role check
        $this->middleware(['auth', 'role:super-admin']);
    }

    /**
     * Display wedding account creation form.
     * AC: 1 - Show form with couple names, email/phone, password fields
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
                'package_tier' => 'standard', // Default (Story 1.3 will make this selectable)
                'wish_present_enabled' => false, // Default (Story 1.4 will add toggles)
                'digital_ang_pow_enabled' => false, // Default (Story 1.4 will add toggles)
                'setup_progress' => 0, // 0% complete (Story 2.6 will track progress)
            ]);

            // Step 2: Create User record with 'couple' role
            $user = User::create([
                'name' => "{$request->bride_name} & {$request->groom_name}",
                'email' => $request->email,
                'password' => $request->password, // Laravel 12 auto-hashes
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
                'created_by' => auth()->user()->id,
            ]);

            // AC: 2 - Bilingual success message
            return redirect()
                ->route('admin.weddings.index') // Or back to create form
                ->with('success', 'Wedding account created successfully! / Akaun perkahwinan berjaya dicipta!');

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
}
```

**FormRequest Validation:**
```php
// app/Http/Requests/StoreWeddingRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWeddingRequest extends FormRequest
{
    /**
     * AC: 2 - Authorize: Only super-admin can create wedding accounts
     */
    public function authorize()
    {
        return auth()->user()->can('create_wedding_accounts'); // Spatie permission
    }

    /**
     * AC: 3, 4 - Validate rules: Required fields, unique email
     */
    public function rules()
    {
        return [
            'bride_name' => ['required', 'string', 'max:255'],
            'groom_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'], // AC: 4 - Unique check
            'password' => ['required', 'string', 'min:8', 'confirmed'], // confirmed requires password_confirmation field
        ];
    }

    /**
     * AC: 3 - Bilingual validation messages (NFR-USE-004)
     */
    public function messages()
    {
        return [
            'bride_name.required' => 'Maaf, nama pengantin perempuan diperlukan. / Sorry, bride name is required.',
            'groom_name.required' => 'Maaf, nama pengantin lelaki diperlukan. / Sorry, groom name is required.',
            'email.required' => 'Maaf, emel atau nombor telefon diperlukan. / Sorry, email is required.',
            'email.email' => 'Maaf, format emel tidak sah. / Sorry, email format is invalid.',
            'email.unique' => 'Maaf, emel ini sudah didaftarkan. / Sorry, this email is already registered.',
            'password.required' => 'Maaf, kata laluan diperlukan. / Sorry, password is required.',
            'password.min' => 'Maaf, kata laluan mesti sekurang-kurangnya 8 aksara. / Sorry, password must be at least 8 characters.',
            'password.confirmed' => 'Maaf, pengesahan kata laluan tidak sepadan. / Sorry, password confirmation does not match.',
        ];
    }
}
```

### Routes (routes/web.php)

```php
use App\Http\Controllers\Admin\WeddingController;

// Admin routes group (already exists from Story 1.1)
Route::middleware(['auth', 'role:super-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Existing admin routes (login, dashboard, logout)
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // NEW: Wedding account management routes
        Route::get('/weddings/create', [WeddingController::class, 'create'])->name('weddings.create');
        Route::post('/weddings', [WeddingController::class, 'store'])->name('weddings.store');
        Route::get('/weddings', [WeddingController::class, 'index'])->name('weddings.index'); // For future Story 7.1

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
```

### Vue 3 Component (Admin/CreateWedding.vue)

```vue
<!-- resources/js/Pages/Admin/CreateWedding.vue -->
<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    // Inertia will automatically pass flash messages (success, error)
});

const form = useForm({
    bride_name: '',
    groom_name: '',
    email: '',
    password: '',
    password_confirmation: '', // For confirmed validation rule
});

const submit = () => {
    form.post(route('admin.weddings.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Create Wedding Account" />

    <div class="min-h-screen bg-gray-100">
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <h1 class="text-3xl font-bold text-gray-900">
                        Create Wedding Account
                    </h1>
                    <Link
                        :href="route('admin.dashboard')"
                        class="text-gray-600 hover:text-gray-900"
                    >
                        Back to Dashboard
                    </Link>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <!-- Bilingual Success Message -->
                    <div v-if="$page.props.flash.success" class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ $page.props.flash.success }}
                    </div>

                    <!-- Bilingual Error Message -->
                    <div v-if="$page.props.flash.error" class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        {{ $page.props.flash.error }}
                    </div>

                    <form @submit.prevent="submit">
                        <!-- Bride Name -->
                        <div class="mb-4">
                            <label for="bride_name" class="block text-gray-700 font-medium mb-2">
                                Bride Name / Nama Pengantin Perempuan
                            </label>
                            <input
                                id="bride_name"
                                v-model="form.bride_name"
                                type="text"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required
                                autofocus
                            />
                            <div v-if="form.errors.bride_name" class="mt-2 text-sm text-red-600">
                                {{ form.errors.bride_name }}
                            </div>
                        </div>

                        <!-- Groom Name -->
                        <div class="mb-4">
                            <label for="groom_name" class="block text-gray-700 font-medium mb-2">
                                Groom Name / Nama Pengantin Lelaki
                            </label>
                            <input
                                id="groom_name"
                                v-model="form.groom_name"
                                type="text"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required
                            />
                            <div v-if="form.errors.groom_name" class="mt-2 text-sm text-red-600">
                                {{ form.errors.groom_name }}
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-medium mb-2">
                                Email / Emel
                            </label>
                            <input
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required
                            />
                            <div v-if="form.errors.email" class="mt-2 text-sm text-red-600">
                                {{ form.errors.email }}
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 font-medium mb-2">
                                Password / Kata Laluan
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

                        <!-- Password Confirmation -->
                        <div class="mb-6">
                            <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">
                                Confirm Password / Sahkan Kata Laluan
                            </label>
                            <input
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                type="password"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required
                            />
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50"
                        >
                            {{ form.processing ? 'Creating...' : 'Create Wedding Account' }}
                        </button>
                    </form>

                    <!-- AC: 5 - Display credentials for sharing -->
                    <div v-if="$page.props.flash.success" class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded">
                        <h3 class="text-lg font-semibold text-blue-900 mb-2">
                            Share These Credentials with the Couple
                        </h3>
                        <p class="text-gray-700">
                            <strong>Email:</strong> {{ form.email }}
                        </p>
                        <p class="text-gray-700">
                            <strong>Password:</strong> [Use the password you set above]
                        </p>
                        <p class="text-sm text-gray-600 mt-2">
                            Please share these credentials securely via WhatsApp or phone.
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
```

### Testing Requirements

**Test File: tests/Feature/Admin/CreateWeddingTest.php**

```php
namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Wedding;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateWeddingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create roles and permissions
        Role::create(['name' => 'super-admin']);
        Role::create(['name' => 'couple']);
    }

    /** @test */
    public function super_admin_can_view_create_wedding_form()
    {
        // Arrange: Create super admin
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Act: Visit create page
        $response = $this->actingAs($superAdmin)->get('/admin/weddings/create');

        // Assert: Form renders successfully
        $response->assertStatus(200);
        $response->assertInertia(function ($page) {
            expect($page->component())->toBe('Admin/CreateWedding');
        });
    }

    /** @test */
    public function super_admin_can_create_wedding_account_with_valid_data()
    {
        // Arrange: Create super admin
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Act: Submit form with valid data
        $response = $this->actingAs($superAdmin)->post('/admin/weddings', [
            'bride_name' => 'Siti',
            'groom_name' => 'Ahmad',
            'email' => 'siti.ahmad@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Assert: Wedding and User created, user has 'couple' role
        $this->assertDatabaseHas('weddings', [
            'bride_name' => 'Siti',
            'groom_name' => 'Ahmad',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'siti.ahmad@example.com',
            'name' => 'Siti & Ahmad',
        ]);

        $user = User::where('email', 'siti.ahmad@example.com')->first();
        $this->assertTrue($user->hasRole('couple'));
        $this->assertNotNull($user->wedding_id);

        $response->assertRedirect('/admin/weddings');
        $response->assertSessionHas('success');
    }

    /** @test */
    public function validation_fails_with_missing_required_fields()
    {
        // Arrange: Create super admin
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Act: Submit form with missing fields
        $response = $this->actingAs($superAdmin)->post('/admin/weddings', [
            'bride_name' => '', // Missing
            'groom_name' => '', // Missing
            'email' => '', // Missing
            'password' => '', // Missing
        ]);

        // Assert: Validation errors, no records created
        $response->assertSessionHasErrors(['bride_name', 'groom_name', 'email', 'password']);

        $this->assertDatabaseCount('weddings', 0);
        $this->assertDatabaseCount('users', 1); // Only super admin
    }

    /** @test */
    public function duplicate_email_is_rejected()
    {
        // Arrange: Create existing user and super admin
        User::factory()->create(['email' => 'existing@example.com']);
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Act: Try to create wedding with existing email
        $response = $this->actingAs($superAdmin)->post('/admin/weddings', [
            'bride_name' => 'Siti',
            'groom_name' => 'Ahmad',
            'email' => 'existing@example.com', // Duplicate
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Assert: Validation error, no wedding created
        $response->assertSessionHasErrors(['email']);
        $this->assertDatabaseCount('weddings', 0);
    }

    /** @test */
    public function non_super_admin_cannot_access_create_wedding()
    {
        // Arrange: Create regular user (not super-admin)
        $user = User::factory()->create();

        // Act: Try to access create page
        $response = $this->actingAs($user)->get('/admin/weddings/create');

        // Assert: Forbidden (403)
        $response->assertStatus(403);
    }

    /** @test */
    public function guest_cannot_access_create_wedding()
    {
        // Act: Try to access create page without authentication
        $response = $this->get('/admin/weddings/create');

        // Assert: Redirect to login
        $response->assertRedirect('/login');
    }

    /** @test */
    public function password_is_hashed_using_bcrypt()
    {
        // Arrange: Create super admin
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Act: Create wedding with password
        $this->actingAs($superAdmin)->post('/admin/weddings', [
            'bride_name' => 'Siti',
            'groom_name' => 'Ahmad',
            'email' => 'siti.ahmad@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Assert: Password is hashed
        $user = User::where('email', 'siti.ahmad@example.com')->first();
        $this->assertNotEquals('password123', $user->password);
        $this->assertTrue(\Hash::check('password123', $user->password));
    }

    /** @test */
    public function wedding_account_creation_logs_audit_trail()
    {
        // Arrange: Create super admin
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Act: Create wedding
        $this->actingAs($superAdmin)->post('/admin/weddings', [
            'bride_name' => 'Siti',
            'groom_name' => 'Ahmad',
            'email' => 'siti.ahmad@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Assert: Log entry created
        // Note: Actual log checking depends on your logging configuration
        // This is a placeholder test - implement based on your log storage
        $this->assertTrue(true); // Placeholder
    }
}
```

### Project Structure Notes

**File Locations:**
- Controllers: `app/Http/Controllers/Admin/WeddingController.php`
- Models: `app/Models/Wedding.php`, `app/Models/User.php` (update relationship)
- Requests: `app/Http/Requests/StoreWeddingRequest.php`
- Routes: `routes/web.php` (add wedding routes to admin group)
- Vue Pages: `resources/js/Pages/Admin/CreateWedding.vue`
- Migrations: `database/migrations/YYYY_MM_DD_HHMMSS_create_weddings_table.php`
- Tests: `tests/Feature/Admin/CreateWeddingTest.php`

**Naming Conventions:**
- Database: Singular snake_case (weddings, users)
- Models: Singular PascalCase (Wedding, User)
- Controllers: Singular PascalCase, organized by role (Admin/WeddingController)
- Vue Components: PascalCase (Admin/CreateWedding.vue)
- Routes: Dot notation with role prefix (admin.weddings.create, admin.weddings.store)

### References

- [Source: _bmad-output/planning-artifacts/epics.md#Story 1.2](../planning-artifacts/epics.md#story-12-create-couple-account)
- [Source: _bmad-output/planning-artifacts/architecture.md#Multi-Tenancy](../planning-artifacts/architecture.md#multi-tenancy--security)
- [Source: _bmad-output/project-context.md#Critical Rules](project-context.md#critical-implementation-rules)
- [Source: _bmad-output/project-context.md#Controller Organization](project-context.md#critical-controller-organization-by-role)
- [Source: Story 1.1 implementation](1-1-super-admin-authentication.md)

## Dev Agent Record

### Agent Model Used

Claude Sonnet 4.5 (claude-sonnet-4-5-20250929)

### Debug Log References

None - Initial story creation.

### Completion Notes List

**Story Preparation Complete (2026-01-21):**
- ✅ Epic and story requirements extracted from epics.md
- ✅ Previous story (1.1) intelligence analyzed and integrated
- ✅ Database schema designed with wedding_id foreign key for multi-tenancy
- ✅ Controller structure follows role-based organization (Admin/WeddingController)
- ✅ Spatie Permissions integration for 'couple' role assignment
- ✅ Bilingual validation messages (English/Bahasa Malaysia)
- ✅ Vue 3 Composition API component designed
- ✅ Comprehensive test coverage defined (8 test cases)
- ✅ Security requirements documented (password hashing, role checks)
- ✅ AC mapping complete (5 acceptance criteria → 7 tasks)

**Story Implementation Complete (2026-01-21):**
- ✅ All 6 tasks completed with red-green-refactor TDD cycle
- ✅ Weddings table migration created with all future story fields prepared
- ✅ Wedding model with hasOne(User) relationship
- ✅ User model updated with wedding_id foreign key, phone field, and belongsTo(Wedding) relationship
- ✅ Admin/WeddingController with create, store, index methods
- ✅ StoreWeddingRequest with comprehensive bilingual validation rules (names, email, phone, optional password)
- ✅ Admin routes configured with auth + role:super-admin middleware
- ✅ Vue 3 Composition API CreateWedding page with form, phone field, credentials display
- ✅ PermissionSeeder updated with 'couple' role and firstOrCreate pattern
- ✅ 12 comprehensive test cases covering all ACs - all passing (43 assertions)
- ✅ TDD cycle followed: RED (failing tests) → GREEN (implementation) → REFACTOR (clean code)
- ✅ Database transactions ensure atomic wedding+user creation
- ✅ Audit logging for account creation events (including phone and password source)
- ✅ Password hashing verified via Laravel 12 auto-casting
- ✅ Phone number used as default password with custom override option

**Code Review Fixes Applied (2026-01-21):**
- ✅ **FIXED #1 (HIGH):** AC5 credentials display - Controller now returns back() with credentials in flash session
- ✅ **FIXED #2 (HIGH):** Security - Changed onDelete('cascade') to onDelete('restrict') to prevent accidental user deletion
- ✅ **FIXED #3 (HIGH):** Task 5.3 - Credentials now display actual email, phone, and password (not placeholder)
- ✅ **FIXED #4 (HIGH):** AC5 verification - Added test to verify couple can authenticate with phone-as-password
- ✅ **ENHANCEMENT:** Added phone number field to form (required) with Malaysian phone validation
- ✅ **ENHANCEMENT:** Phone number used as default password (custom password optional)
- ✅ **FIXED #7 (MEDIUM):** Test coverage expanded from 7 to 12 tests (43 assertions)
  - Added phone validation tests
  - Added default password behavior tests
  - Added custom password override tests
  - Added couple authentication verification test
  - Added audit logging verification test

**Key Technical Decisions:**
- Wedding record created first, then User with wedding_id link (ensures referential integrity)
- Database transaction used for atomic creation (both wedding and user succeed or both fail)
- User.name stores "Bride & Groom" format for display
- User.phone stores contact number AND serves as default password (unless custom password provided)
- Wedding table prepared for future stories (package_tier, feature toggles, setup_progress)
- Laravel 12 auto-hashing for passwords (no manual bcrypt needed)
- Inertia.js for page rendering with flash session for credentials display (no REST API endpoints)
- Middleware applied via routes (not controller constructor) following Story 1.1 pattern
- Security: onDelete('restrict') on wedding_id foreign key prevents accidental user deletion
- Phone validation accepts Malaysian formats: standard (0123456789), country code (+6012...), with formatting (01-2345 6789)

**Developer Handoffs:**
- Wedding migration created successfully
- User.wedding_id column added via migration (with restrict delete for security)
- User.phone column added for contact and default password
- Admin routes already organized from Story 1.1
- Spatie Permissions and HasRoles trait already installed
- Breeze authentication already configured
- Phone-as-password pattern established (custom password optional)
- Credentials display via flash session implemented (admin can share with couples)

### File List

**Files Created:**
- `app/Models/Wedding.php` (new model with relationships and fillable fields)
- `app/Http/Controllers/Admin/WeddingController.php` (new controller with create, store, index methods)
- `app/Http/Requests/StoreWeddingRequest.php` (new FormRequest with bilingual validation and phone field)
- `database/migrations/2026_01_21_040111_create_weddings_table.php` (weddings table schema)
- `database/migrations/2026_01_21_040123_add_wedding_id_to_users_table.php` (foreign key addition with onDelete('restrict'))
- `database/migrations/2026_01_21_060247_add_phone_to_users_table.php` (phone column for contact and default password)
- `resources/js/Pages/Admin/CreateWedding.vue` (new Vue page with form, phone field, credentials display)
- `resources/js/Pages/Admin/Weddings.vue` (placeholder for future Story 7.1)
- `tests/Feature/Admin/CreateWeddingTest.php` (comprehensive test suite with 12 test cases, 43 assertions)

**Files Modified:**
- `app/Models/User.php` (added phone to fillable, wedding_id and wedding() relationship from Story 1.1)
- `routes/web.php` (added wedding routes: create, store, index)
- `database/seeders/PermissionSeeder.php` (updated to use firstOrCreate, added 'couple' role creation)

**Dependencies:**
- Requires Story 1.1 complete (Laravel Breeze, Spatie Permissions, Admin routes)
- No additional packages needed
- Uses existing Inertia.js, Vue 3, Tailwind setup
