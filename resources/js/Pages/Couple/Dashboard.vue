<template>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">
            Welcome, {{ $page.props.auth.user.wedding?.bride_name || 'Couple' }}!
        </h1>

        <!-- Upgrade Prompt for Standard Couples -->
        <div v-if="isStandardPackage" class="mt-6 bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">
                        Unlock Premium Features
                    </h2>
                    <p class="mt-2 text-gray-600">
                        Upgrade to Premium (RM30) to access Wish Present Registry and Digital Ang Pow.
                    </p>
                    <p class="mt-1 text-sm text-purple-600 font-medium">
                        Only RM10 difference from your current Standard package.
                    </p>
                </div>
                <button
                    @click="requestUpgrade"
                    :disabled="form.processing"
                    class="px-6 py-3 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 disabled:opacity-50"
                >
                    {{ form.processing ? 'Sending...' : 'Upgrade to Premium - Add RM10' }}
                </button>
            </div>
        </div>

        <!-- Rest of dashboard content... -->
        <div class="mt-8">
            <p class="text-gray-600">Your dashboard content will be expanded in future stories.</p>
        </div>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const form = useForm();

const isStandardPackage = computed(() => {
    return $page.props.auth.user.wedding?.package_tier === 'standard';
});

const requestUpgrade = () => {
    form.post(route('couple.upgrade-request.store'), {
        onSuccess: () => {
            alert('Upgrade request sent! We will contact you soon.');
        },
    });
};
</script>
