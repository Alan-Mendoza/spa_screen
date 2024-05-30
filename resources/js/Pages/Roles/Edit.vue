<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import JetInputError from '@/Components/InputError.vue';

const props = defineProps({
    role: Object,
});

// Almacenamos el valor original del nombre del documento
const originalName = props.role.name;

// Incializamos el formulario
const form = useForm({
    name: props.role.name,
    id: props.role.id,
});

// Función para enviar el formulario
function submit() {
    form.put(`/roles/${props.role.id}`, {
        onError: (errors) => {
            // Si hay errores, restauramos el valor original del nombre
            form.name = originalName;
        }
    });
}
</script>

<template>
    <AppLayout title="Roles">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Role
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mt-10 sm:mt-0">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1 pt-5 pl-5">
                            <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Role Information</h3>
                            <p class="mt-1 text-sm text-gray-600">Enter the necessary information here to update the role name.</p>
                            </div>
                        </div>
                        <div class="mt-5 md:col-span-2 md:mt-0">
                            <form @submit.prevent="submit()">
                            <div class="overflow-hidden shadow sm:rounded-md">
                                <div class="bg-white px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Name Role</label>
                                        <input v-model="form.name" type="text" name="name" id="name" autocomplete="given-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                        <jet-input-error :message="form.errors.name" class="mt-2" />
                                    </div>
                                </div>
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
