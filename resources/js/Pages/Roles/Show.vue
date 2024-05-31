<script setup>
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    role: Object,
});

</script>

<template>
    <AppLayout title="Roles">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Role
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">{{ role.id }}</h3>
                        <p class="text-gray-600">{{ role.name }}</p>
                        <p class="text-gray-600">{{ role.guard_name }}</p>
                        <p class="text-gray-600">{{ role.created_at }}</p>
                    </div>
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Permissions</h3>
                            <template v-if="role.permissions && role.permissions.length > 0">
                                <span v-for="permission in role.permissions" :key="permission.id" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-600 text-white mr-1">
                                    {{ permission.name }}
                                </span>
                            </template>
                            <template v-else>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-500 text-white mr-1">No permissions</span>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
