<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { watch } from 'vue';

const page = usePage();

const props = defineProps({
    wedding: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    bride_name: props.wedding.bride_name,
    groom_name: props.wedding.groom_name,
    package_tier: props.wedding.package_tier,
    wish_present_enabled: props.wedding.wish_present_enabled ?? false,
    digital_ang_pow_enabled: props.wedding.digital_ang_pow_enabled ?? false,
});

// Auto-check/uncheck features based on package tier
watch(() => form.package_tier, (newTier, oldTier) => {
    if (oldTier && newTier !== oldTier) {
        if (newTier === 'premium') {
            // Upgrading: confirm with user (AC: 1)
            const confirmed = confirm('Upgrade this couple to Premium package? Features will be unlocked immediately. / Naik taraf pasangan ini ke pakej Premium? Ciri-ciri akan dibuka serta-merta.');
            if (!confirmed) {
                form.package_tier = oldTier; // Revert
                return;
            }
            // Auto-enable both features
            form.wish_present_enabled = true;
            form.digital_ang_pow_enabled = true;
        } else if (newTier === 'standard') {
            // Downgrading: confirm with user
            const confirmed = confirm('Downgrading to Standard will lock premium features. Continue? / Menurunkan taraf ke Standard akan mengunci ciri-ciri Premium. Teruskan?');
            if (!confirmed) {
                form.package_tier = oldTier; // Revert
            } else {
                form.wish_present_enabled = false;
                form.digital_ang_pow_enabled = false;
            }
        }
    }
});

const submit = () => {
    form.put(route('admin.weddings.update', props.wedding.id), {
        onFinish: () => {
            // Form reset happens automatically on success
        },
    });
};
</script>

<template>
    <Head title="Edit Wedding Account" />

    <div class="min-h-screen bg-gray-100">
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <h1 class="text-3xl font-bold text-gray-900">
                        Edit Wedding Account
                    </h1>
                    <Link
                        :href="route('admin.weddings.index')"
                        class="text-gray-600 hover:text-gray-900"
                    >
                        Back to Weddings
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

                        <!-- Email (Read-only) -->
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">
                                Email / Emel
                            </label>
                            <input
                                type="email"
                                :value="wedding.user.email"
                                class="w-full px-3 py-2 border rounded-lg bg-gray-100 text-gray-600"
                                disabled
                            />
                            <p class="mt-1 text-xs text-gray-500">
                                Email cannot be changed
                            </p>
                        </div>

                        <!-- Phone (Read-only) -->
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">
                                Phone / Nombor Telefon
                            </label>
                            <input
                                type="tel"
                                :value="wedding.user.phone"
                                class="w-full px-3 py-2 border rounded-lg bg-gray-100 text-gray-600"
                                disabled
                            />
                            <p class="mt-1 text-xs text-gray-500">
                                Phone cannot be changed
                            </p>
                        </div>

                        <!-- Package Tier Selection -->
                        <div class="mb-4">
                            <label for="package_tier" class="block text-gray-700 font-medium mb-2">
                                Package Tier / Pakej
                            </label>
                            <select
                                id="package_tier"
                                v-model="form.package_tier"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                                name="package_tier"
                            >
                                <option value="standard">Standard (RM20)</option>
                                <option value="premium">Premium (RM30)</option>
                            </select>
                            <p class="mt-1 text-sm text-gray-600">
                                Upgrading to Premium will instantly unlock Wish Present and Digital Ang Pow features.
                                Downgrading to Standard will lock these features (data retained).
                            </p>
                            <div v-if="form.errors.package_tier" class="mt-2 text-sm text-red-600">
                                {{ form.errors.package_tier }}
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50"
                        >
                            {{ form.processing ? 'Updating...' : 'Update Wedding Account' }}
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</template>
