---
project_name: 'JomNikah'
user_name: 'Amirrul'
date: '2026-01-19'
sections_completed: ['technology_stack', 'critical_rules', 'patterns', 'anti_patterns', 'quick_reference']
status: 'complete'
rule_count: 10
optimized_for_llm: true
---

# Project Context for AI Agents

_This file contains critical rules and patterns that AI agents must follow when implementing code in this project. Focus on unobvious details that agents might otherwise miss._

---

## Technology Stack & Versions

**Backend:**
- **Framework:** Laravel 12.17.0 (latest June 2025)
- **PHP:** 8.2+ (required by Laravel 12)
- **Database:** MySQL 8+ (InnoDB engine, utf8mb4 charset)
- **Key Packages:**
  - `spatie/laravel-permission`: Role-based access control
  - `inertiajs/inertia-laravel`: SPA bridge (no REST API)
  - `barryvdh/laravel-dompdf`: PDF generation
  - `fastexcel/fastexcel`: Excel export

**Frontend:**
- **Framework:** Vue 3.4+ (Composition API ONLY, no Options API)
- **Build Tool:** Vite (with Laravel plugin)
- **Styling:** Tailwind CSS v4 (JIT compilation)
- **UI Library:** Headless UI (for accessible components)
- **State:** Vue 3 `ref()`/`reactive()` (NO Pinia, NO Vuex)

**Infrastructure:**
- **Platform:** DigitalOcean droplets (Ubuntu 22.04 LTS)
- **Web Server:** Nginx 1.24+ (wildcard subdomain routing)
- **PHP:** PHP-FPM 8.2 (with Opcache)
- **Process Monitor:** Supervisor (Laravel scheduler only, NO queue workers)

**NO REST API:** This is an Inertia.js monolith - controllers return Inertia responses, not JSON.

---

## Critical Implementation Rules

### 🔴 CRITICAL: Multi-Tenancy Security

**Never access data without wedding_id scoping:**

```php
// ❌ WRONG - Will leak data between weddings
$rsvps = Rsvp::all();

// ✅ CORRECT - Automatic scoping via global scope
$rsvps = auth()->user()->wedding->rsvps;

// ✅ CORRECT - Explicit scoping for queries
$rsvps = Rsvp::where('wedding_id', $weddingId)->get();
```

**Every query MUST be scoped by wedding_id:**
- Global scopes on models automatically filter by `wedding_id`
- Foreign key constraints: `wedding_id` on all tenant-specific tables
- Spatie Permissions check role-based access (Super Admin vs Couple)

**CRITICAL SECURITY RISK:** Violating multi-tenancy causes data leaks between couples.

### 🔴 CRITICAL: No Laravel Queues

**All processing is synchronous:**
- NO queue workers
- NO jobs dispatched
- NO Redis for queue management
- NO `dispatch()` or `dispatchSync()`

**Use Laravel Scheduler for recurring tasks:**
```php
// ✅ CORRECT - Scheduler in app/Console/Kernel.php
$schedule->command('weddings:delete-expired')->dailyAt('03:00');
```

**Real-time updates via polling:**
```javascript
// ✅ CORRECT - Short polling (every 5 seconds)
setInterval(() => fetchUpdates(), 5000);
```

### 🔴 CRITICAL: Feature Locking with Spatie Permissions

**Never hardcode role checks:**

```php
// ❌ WRONG - Hardcoded role check
if (auth()->user()->role === 'admin') {
    // ...
}

// ✅ CORRECT - Spatie Permissions
if (auth()->user()->hasRole('super-admin')) {
    // ...
}

// ✅ CORRECT - Permission-based feature access
if (auth()->user()->can('access_wish_present_registry')) {
    // ...
}
```

**Premium Features:**
- `access_wish_present_registry` (Premium only)
- `access_digital_ang_pow` (Premium only)
- Middleware: `CheckPremiumFeature` redirects to upgrade prompt

### 🔴 CRITICAL: Controller Organization by Role

**Controllers MUST be organized by user role:**

```
app/Http/Controllers/
├── Admin/           ← Super Admin only
│   ├── WeddingController.php (creates couple accounts)
│   └── DashboardController.php
├── Couple/          ← Authenticated couples only
│   ├── WeddingController.php (edits wedding card)
│   ├── RsvpController.php
│   └── PhotoController.php
└── Public/          ← Unauthenticated guests
    └── WeddingCardController.php (displays wedding card)
```

**NEVER mix roles in one controller:**
```php
// ❌ WRONG - WeddingController handling both admin and couple
class WeddingController extends Controller {
    public function create() { /* Admin logic */ }
    public function edit() { /* Couple logic */ }
}

// ✅ CORRECT - Separate controllers per role
// Admin/WeddingController.php (create couple accounts)
// Couple/WeddingController.php (edit wedding card)
```

### 🔴 CRITICAL: Vue 3 Composition API Only

**Always use `<script setup>` syntax:**

```vue
<!-- ❌ WRONG - Options API -->
<script>
export default {
    data() { return { count: 0 } },
    methods: { increment() { this.count++ } }
}
</script>

<!-- ✅ CORRECT - Composition API with script setup -->
<script setup>
import { ref } from 'vue';
const count = ref(0);
const increment = () => count.value++;
</script>
```

**NO Pinia, NO Vuex:**
- Use Vue 3 `ref()` and `reactive()` for local component state
- Use Inertia shared data for global state (auth, wedding, permissions)
- Never install state management libraries

### 🔴 CRITICAL: 3-Layer Component Architecture

**Vue components MUST follow 3-layer system:**

```
resources/js/components/
├── jc-base/           ← Layer 1: Base UI (Tailwind only)
│   ├── JCButton.vue
│   ├── JCInput.vue
│   └── JCCard.vue
├── jc-interactive/    ← Layer 2: Headless UI wrappers
│   ├── JCModal.vue
│   ├── JCDropdown.vue
│   └── JCToast.vue
└── jc-wedding/        ← Layer 3: Emotional UX components
    ├── WeddingCurtain.vue
    ├── CountdownTimer.vue
    └── PhotoGallery.vue
```

**Rules:**
- **ALL components MUST have `jc-` prefix** (prevents third-party conflicts)
- Layer 3 can use Layer 2 and 1
- Layer 2 can use Layer 1 only
- Layer 1 cannot use higher layers

```vue
<!-- ❌ WRONG - No prefix, mixing layers -->
<Button.vue (collision with third-party libraries)
<EmotionalComponent using BaseLayer>

<!-- ✅ CORRECT - jc- prefix, proper layering -->
<JCButton /> (jc-base)
<WeddingCurtain /> (jc-wedding, uses JCModal from jc-interactive)
```

### 🔴 CRITICAL: Database Naming Conventions

**Table Names:**
- **Pattern:** Singular, snake_case
- **Examples:** `users`, `weddings`, `rsvps`, `guestbook`
- **Anti-Pattern:** ❌ `User`, `tbl_users`, `WeddingGuests`

**Column Names:**
- **Pattern:** snake_case, descriptive
- **Foreign Keys:** `{table}_id` format
- **Examples:** `wedding_id`, `package_tier`, `created_at`
- **Anti-Pattern:** ❌ `weddingDate`, `weddingId`, `fk_wedding`

**Model Names:**
- **Pattern:** Singular, PascalCase matching table name
- **Examples:** Table `rsvps` → Model `Rsvp`
- **Anti-Pattern:** ❌ `RsvpModel`, `GuestbookEntry`

### 🔴 CRITICAL: Bilingual Error Messages

**ALL user-facing errors MUST be bilingual (English + Bahasa Malaysia):**

```php
// ❌ WRONG - English only
return back()->with('error', 'Please fill in all required fields.');

// ✅ CORRECT - Bilingual
return back()->with('error', 'Maaf, sila isi semua maklumat yang diperlukan.');
// Translation: "Sorry, please fill in all required information."
```

**Tone:** Kind, supportive, warm (not technical jargon)

### 🔴 CRITICAL: Route Naming with Dot Notation

**Always use Laravel dot notation:**

```php
// ❌ WRONG - Inconsistent naming
Route::get('admin/create-wedding', 'AdminWeddingController@create');
Route::post('couple/rsvp', 'CoupleController@storeRsvp');

// ✅ CORRECT - Dot notation with role prefix
Route::middleware(['auth', 'role:super-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('weddings', WeddingController::class);
        // Generates: admin.weddings.index, admin.weddings.store, etc.
    });
```

### 🔴 CRITICAL: WhatsApp Deep Links (No API)

**Use WhatsApp deep links, NOT official API:**

```javascript
// ✅ CORRECT - Deep link (free, no API setup)
const whatsappURL = `https://wa.me/${phone}?text=${encodedMessage}`;
window.open(whatsappURL, '_blank');

// ❌ WRONG - Business API (costs money, not implemented)
await whatsappApi.sendTextMessage(phone, message);
```

**Fallback:** Web form if WhatsApp unavailable

### 🔴 CRITICAL: Photo Upload Validation (<2MB)

**Validate on client AND server:**

```vue
<script setup>
// ❌ WRONG - No client validation
const uploadPhoto = async (file) => {
    await formData.post('/upload', { photo: file });
}

// ✅ CORRECT - Client-side validation before upload
const validatePhoto = (file) => {
    const maxSize = 2 * 1024 * 1024; // 2MB
    if (file.size > maxSize) {
        const sizeInMB = (file.size / (1024 * 1024)).toFixed(1);
        alert(`This photo is ${sizeInMB}MB. Please choose under 2MB for best performance.`);
        return false;
    }
    return true;
}
</script>
```

---

## Important Patterns

### State Management

**Local State:**
```javascript
// ✅ Use ref() for primitive values
const isOpen = ref(false);

// ✅ Use reactive() for objects
const form = reactive({
    subdomain: '',
    wedding_date: '',
    venue: '',
});
```

**Global State (via Inertia):**
```javascript
// ✅ Shared data available in all components
import { usePage } from '@inertiajs/vue3';
const page = usePage();
const wedding = page.props.wedding;  // Available globally
```

### Error Handling

**Kind, bilingual messages:**
```php
// Validation errors
if ($e instanceof ValidationException) {
    return back()->with('error',
        'Maaf, sila isi semua maklumat yang diperlukan.'
    );
}

// Authentication errors
if ($e instanceof AuthenticationException) {
    return redirect()->route('login')
        ->with('error', 'Sila log masuk untuk meneruskan.');
}
```

### Loading States

**Use Inertia's `useForm` helper:**
```vue
<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    subdomain: '',
    wedding_date: '',
});

// form.processing is automatically true during submission
</script>

<template>
    <button :disabled="form.processing">
        {{ form.processing ? 'Saving...' : 'Save Changes' }}
    </button>
</template>
```

### Validation

**Form Request classes for complex validation:**
```php
// app/Http/Requests/StoreWeddingRequest.php
class StoreWeddingRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('create', Wedding::class);
    }

    public function rules()
    {
        return [
            'subdomain' => ['required', 'alpha_dash', 'unique:weddings,subdomain'],
            'wedding_date' => ['required', 'date', 'after:today'],
        ];
    }

    public function messages()
    {
        return [
            'subdomain.alpha_dash' => 'Subdomain must contain only letters, numbers, and dashes.',
        ];
    }
}
```

---

## Anti-Patterns to Avoid

### ❌ Database Anti-Patterns

```php
// ❌ Plural table names
Schema::create('rsvp', function ($table) { ... });

// ❌ CamelCase columns
$table->string('weddingDate');

// ❌ Foreign key without _id suffix
$table->foreignId('wedding')->constrained();
```

### ❌ Controller Anti-Patterns

```php
// ❌ Feature-based organization
app/Http/Controllers/
├── WeddingController.php (handles both admin and couple)
└── AuthController.php

// ✅ Role-based organization
app/Http/Controllers/
├── Admin/WeddingController.php (creates accounts)
├── Couple/WeddingController.php (edits cards)
└── Public/WeddingCardController.php (displays cards)
```

### ❌ Vue Component Anti-Patterns

```vue
<!-- ❌ No jc- prefix -->
<Button.vue />

<!-- ❌ Using Options API -->
<script>
export default {
    data() { return { count: 0 } }
}
</script>

<!-- ❌ Mixing layers (emotional logic in base component) -->
<JCButton @click="showConfetti()" /> (confetti is emotional, not base UI)
```

### ❌ State Management Anti-Patterns

```javascript
// ❌ Installing Pinia/Vuex (unnecessary complexity)
npm install pinia

// ❌ Global state without Inertia
const globalStore = useGlobalStore();
```

---

## Quick Reference

### File Locations

- **Models:** `app/Models/{ModelName}.php`
- **Controllers:** `app/Http/Controllers/{Role}/{Controller}.php`
- **Requests:** `app/Http/Requests/{Action}{Model}Request.php`
- **Migrations:** `database/migrations/YYYY_MM_DD_HHMMSS_{description}.php`
- **Vue Components:** `resources/js/components/{layer}/{ComponentName}.vue`
- **Pages:** `resources/js/pages/{role}/{path}.vue`
- **Tests:** `tests/{Feature|Unit}/{Category}/{TestName}.php`

### Naming Conventions

- **Database:** Singular snake_case tables, snake_case columns
- **Models:** Singular PascalCase
- **Controllers:** Singular PascalCase, organized by role
- **Vue Components:** PascalCase with `jc-` prefix, 3-layer organization
- **Routes:** Dot notation (`{role}.{resource}.{action}`)
- **Variables:** camelCase for JS/PHP, snake_case for DB

### Key Dependencies

```json
{
  "require": {
    "laravel/framework": "^12.0",
    "spatie/laravel-permission": "^6.0",
    "inertiajs/inertia-laravel": "^1.0"
  },
  "require-dev": {
    "barryvdh/laravel-dompdf": "^2.0",
    "fastexcel/fastexcel": "^1.0"
  }
}
```

---

## Usage Guidelines

**For AI Agents:**

- Read this file before implementing any code
- Follow ALL rules exactly as documented
- When in doubt, prefer the more restrictive option
- Update this file if new patterns emerge during implementation
- Always check the critical rules (🔴) first - these represent security risks or architectural violations

**For Humans:**

- Keep this file lean and focused on agent needs
- Update when technology stack changes
- Review quarterly for outdated rules
- Remove rules that become obvious over time
- Add new critical rules as patterns emerge from implementation

**Maintenance Priority:**

1. **🔴 CRITICAL rules** - Security risks and architectural violations (never remove)
2. **Technology Stack** - Update when upgrading dependencies
3. **Patterns** - Refine based on implementation experience
4. **Anti-Patterns** - Add new common mistakes as discovered

---

**Last Updated:** 2026-01-19
**Architecture Document:** `_bmad-output/planning-artifacts/architecture.md` (comprehensive reference)
