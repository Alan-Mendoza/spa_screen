<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import JetInputError from '@/Components/InputError.vue';
import { ref } from 'vue';

defineProps({
    users: Array,
    roles: Object,
});

const selectedRoles = ref([]);

const form = useForm({
    name: '',
    username: '',
    email: '',
    password: '',
    roles: [],
});

function submit() {
    form.roles = [...selectedRoles.value];  // Asegúrate de que los roles seleccionados se añadan al formulario
    form.post('/users');
};
</script>

<template>
    <AppLayout title="Users">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create User
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mt-10 sm:mt-0">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1 pt-5 pl-5">
                            <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">User Information</h3>
                            <p class="mt-1 text-sm text-gray-600">Enter the information necessary for this user.</p>
                            </div>
                        </div>
                        <div class="mt-5 md:col-span-2 md:mt-0">
                            <form @submit.prevent="submit()">
                            <div class="overflow-hidden shadow sm:rounded-md">
                                <div class="bg-white px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-1 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Fullname</label>
                                        <input v-model="form.name" type="text" name="name" id="name" autocomplete="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" autofocus/>
                                        <jet-input-error :message="form.errors.name" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                        <input v-model="form.username" type="text" name="username" id="username" autocomplete="username" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                        <jet-input-error :message="form.errors.username" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input v-model="form.email" type="email" name="email" id="email" autocomplete="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                        <jet-input-error :message="form.errors.email" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                        <input v-model="form.password" type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                        <jet-input-error :message="form.errors.password" class="mt-2" />
                                    </div>
                                </div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mt-5">Roles</label>
                                <fieldset class="space-y-5">
                                    <legend class="sr-only">Notifications</legend>
                                    <div class="relative flex items-start" v-for="(name, id) in roles" :key="id">
                                        <div class="flex h-5 items-center">
                                            <input :id="'role-' + id" v-model="selectedRoles" aria-describedby="comments-description" name="role[]" type="checkbox" :value="id" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label :for="'role-' + id" class="font-medium text-gray-700">{{ name }}</label>
                                        </div>
                                    </div>
                                </fieldset>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                                </div>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
