<script setup>
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    weddings: Array,
});
</script>

<template>
    <Head title="Weddings" />
    <div class="min-h-screen bg-gray-100">
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <h1 class="text-3xl font-bold text-gray-900">Wedding Accounts</h1>
                    <Link
                        :href="route('admin.weddings.create')"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
                    >
                        Create New Account
                    </Link>
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div v-if="weddings && weddings.length > 0">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Couple Names
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Package Tier
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="wedding in weddings" :key="wedding.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ wedding.bride_name }} & {{ wedding.groom_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ wedding.user ? wedding.user.email : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            :class="{
                                                'bg-gray-100 text-gray-800': wedding.package_tier === 'standard',
                                                'bg-purple-100 text-purple-800': wedding.package_tier === 'premium'
                                            }"
                                            class="px-2 py-1 text-xs font-semibold rounded-full"
                                        >
                                            {{ wedding.package_tier === 'premium' ? 'Premium (RM30)' : 'Standard (RM20)' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <!-- Future: Add edit/delete actions in Story 7.1 -->
                                        <span class="text-gray-400">Actions in Story 7.1</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-else class="text-center py-8">
                        <p class="text-gray-500">No wedding accounts found. Create your first account!</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
