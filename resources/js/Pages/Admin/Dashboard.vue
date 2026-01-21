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
