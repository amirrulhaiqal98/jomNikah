<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { watch } from 'vue';

const page = usePage();

const props = defineProps({
    // Inertia will automatically pass flash messages (success, error)
    // Credentials passed from backend after successful creation
});

const form = useForm({
    bride_name: '',
    groom_name: '',
    email: '',
    phone: '', // Phone number for contact and default password
    password: '',
    password_confirmation: '', // For confirmed validation rule
    package_tier: 'standard', // Default to standard package
    wish_present_enabled: false, // Story 1.4 - Default to unchecked
    digital_ang_pow_enabled: false, // Story 1.4 - Default to unchecked
});

// Get credentials from flash session (if available)
const coupleCredentials = page.props.flash.couple_credentials || null;

// Auto-check both for Premium package (Story 1.4)
// FIXED: This is a convenience default for Premium tier. Admin can override by unchecking boxes manually.
// Purpose: Save time for admins while maintaining flexibility for promotional access.
watch(() => form.package_tier, (newTier) => {
    if (newTier === 'premium') {
        form.wish_present_enabled = true;
        form.digital_ang_pow_enabled = true;
    } else {
        form.wish_present_enabled = false;
        form.digital_ang_pow_enabled = false;
    }
});

const submit = () => {
    form.post(route('admin.weddings.store'), {
        onFinish: () => {
            // Don't reset form if successful - we need to show credentials
            // Only clear password fields for security
            if (!page.props.flash.success) {
                form.reset('password', 'password_confirmation');
            }
        },
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
                        <!-- AC: 5 - Display credentials for sharing (shown after successful creation) -->
                        <div v-if="$page.props.flash.couple_credentials" class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded">
                            <h3 class="text-lg font-semibold text-blue-900 mb-2">
                                ✅ Wedding Account Created! Share These Credentials with the Couple
                            </h3>
                            <div class="space-y-2">
                                <p class="text-gray-700">
                                    <strong>Names:</strong> {{ $page.props.flash.couple_credentials.bride_name }} & {{ $page.props.flash.couple_credentials.groom_name }}
                                </p>
                                <p class="text-gray-700">
                                    <strong>Email:</strong> {{ $page.props.flash.couple_credentials.email }}
                                </p>
                                <p class="text-gray-700">
                                    <strong>Phone:</strong> {{ $page.props.flash.couple_credentials.phone }}
                                </p>
                                <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded">
                                    <p class="text-gray-800 font-medium">
                                        🔑 <strong>Password:</strong> {{ $page.props.flash.couple_credentials.password }}
                                    </p>
                                    <p v-if="$page.props.flash.couple_credentials.password_source === 'phone'" class="text-xs text-gray-600 mt-1">
                                        (Phone number used as default password)
                                    </p>
                                    <p v-else class="text-xs text-gray-600 mt-1">
                                        (Custom password as set above)
                                    </p>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 mt-3">
                                📱 Please share these credentials securely via WhatsApp or phone.
                            </p>
                            <p class="text-xs text-red-600 mt-2">
                                ⚠️ Copy these credentials now - they will not be shown again after you leave this page.
                            </p>
                        </div>

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

                        <!-- Package Tier Selection -->
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">
                                Package Tier / Pakej
                            </label>

                            <!-- Standard Option -->
                            <label class="flex items-center p-3 border rounded-lg mb-2 cursor-pointer hover:bg-gray-50">
                                <input
                                    v-model="form.package_tier"
                                    type="radio"
                                    value="standard"
                                    class="mr-3"
                                    name="package_tier"
                                />
                                <div>
                                    <span class="font-semibold text-gray-900">Standard (RM20)</span>
                                    <p class="text-sm text-gray-600">Basic wedding card features</p>
                                </div>
                            </label>

                            <!-- Premium Option -->
                            <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input
                                    v-model="form.package_tier"
                                    type="radio"
                                    value="premium"
                                    class="mr-3"
                                    name="package_tier"
                                />
                                <div>
                                    <span class="font-semibold text-gray-900">Premium (RM30)</span>
                                    <p class="text-sm text-gray-600">All features + Wish Present + Digital Ang Pow</p>
                                </div>
                            </label>

                            <div v-if="form.errors.package_tier" class="mt-2 text-sm text-red-600">
                                {{ form.errors.package_tier }}
                            </div>
                        </div>

                        <!-- Feature Toggles Section (Story 1.4) -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">
                                Premium Features / Fitur Premium
                            </h3>
                            <p class="text-sm text-gray-600 mb-4">
                                Enable premium features for this couple regardless of package tier.
                                These features will override default package settings.
                            </p>

                            <!-- Wish Present Registry Toggle -->
                            <label class="flex items-center p-3 border rounded-lg mb-2 cursor-pointer hover:bg-white transition">
                                <input
                                    v-model="form.wish_present_enabled"
                                    type="checkbox"
                                    class="mr-3 h-5 w-5 text-purple-600 rounded"
                                    name="wish_present_enabled"
                                />
                                <div>
                                    <span class="font-semibold text-gray-900">Enable Wish Present Registry</span>
                                    <p class="text-sm text-gray-600">Allow guests to claim gifts from registry</p>
                                </div>
                            </label>

                            <!-- Digital Ang Pow Toggle -->
                            <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-white transition">
                                <input
                                    v-model="form.digital_ang_pow_enabled"
                                    type="checkbox"
                                    class="mr-3 h-5 w-5 text-purple-600 rounded"
                                    name="digital_ang_pow_enabled"
                                />
                                <div>
                                    <span class="font-semibold text-gray-900">Enable Digital Ang Pow</span>
                                    <p class="text-sm text-gray-600">Allow couples to collect monetary gifts privately</p>
                                </div>
                            </label>
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

                        <!-- Phone Number -->
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700 font-medium mb-2">
                                Phone Number / Nombor Telefon
                            </label>
                            <input
                                id="phone"
                                v-model="form.phone"
                                type="tel"
                                placeholder="e.g., 0123456789"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required
                            />
                            <div v-if="form.errors.phone" class="mt-2 text-sm text-red-600">
                                {{ form.errors.phone }}
                            </div>
                            <p class="mt-1 text-xs text-gray-500">
                                💡 This will be the default password for the couple's account
                            </p>
                        </div>

                        <!-- Password (Optional - defaults to phone number if left empty) -->
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 font-medium mb-2">
                                Password (Optional) / Kata Laluan (Pilihan)
                            </label>
                            <input
                                id="password"
                                v-model="form.password"
                                type="password"
                                placeholder="Leave empty to use phone number as password"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            />
                            <div v-if="form.errors.password" class="mt-2 text-sm text-red-600">
                                {{ form.errors.password }}
                            </div>
                            <p class="mt-1 text-xs text-gray-500">
                                💡 If empty, phone number will be used as the default password
                            </p>
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
                                placeholder="Re-enter password if you set one above"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
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
                </div>
            </div>
        </main>
    </div>
</template>
