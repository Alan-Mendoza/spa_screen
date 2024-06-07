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
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
