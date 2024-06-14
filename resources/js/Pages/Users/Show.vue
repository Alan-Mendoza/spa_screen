<script setup>
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    user: Object,
});

</script>

<template>
    <AppLayout title="Users">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">{{ user.id }}</h3>
                        <p class="text-gray-600">{{ user.name }}</p>
                        <p class="text-gray-600">{{ user.username }}</p>
                        <p class="text-gray-600">{{ user.email }}</p>
                        <p class="text-gray-600">{{ user.created_at }}</p>
                        <h4 class="block text-sm font-medium text-gray-700 mt-5">Roles</h4>
                        <p class="text-gray-600">
                            <template v-if="user.roles && user.roles.length > 0">
                                <span v-for="role in user.roles" :key="role.id" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-600 text-white mr-1">
                                    {{ role.name }}
                                </span>
                            </template>
                            <template v-else>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-500 text-white mr-1">No roles</span>
                            </template>
                        </p>
                        <h4 class="block text-sm font-medium text-gray-700 mt-5">Permissions</h4>
                        <p class="text-gray-600">
                            <template v-if="user.permissions && user.permissions.length > 0">
                                <span v-for="permission in user.permissions" :key="permission.id" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-600 text-white mr-1">
                                    {{ permission.name }}
                                </span>
                            </template>
                            <template v-else>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-500 text-white mr-1">No roles</span>
                            </template>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
