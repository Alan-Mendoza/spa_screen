<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

import JetPrimaryButton from '@/Components/PrimaryButton.vue';
import JetInputError from '@/Components/InputError.vue';
import JetModal from '@/Components/Modal.vue';
import JetTextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';

// Modal
const acting = ref(false);

const form = useForm({
    name: '',
});

let mode = 'create';
let selectedPost = null;

const openModal = (newMode, post = null) => {
    mode = newMode;
    selectedPost = post;

    if (newMode === 'edit' || newMode === 'show') {
        form.name = post ? post.name : '';
    } else {
        form.reset();
    }

    acting.value = true;
};

const submit = () => {
    if (mode === 'create') {
        form.post(route('posts.store'), {
            preserveScroll: true,
            onSuccess: () => {
                form.reset('name');
                acting.value = false;
            }
        });
    } else if (mode === 'edit') {
        if (!selectedPost) return;

        form.put(route('posts.update', [selectedPost.id]), {
            preserveScroll: true,
            onError: () => {
                // Restaurar el valor original en caso de error de validación
                form.name = selectedPost.name;
            },
            onSuccess: () => {
                form.reset('name');
                acting.value = false;
                mode = 'create';
                selectedPost = null;
            }
        });
    } else if (mode === 'delete') {
        if (!selectedPost) return;

        form.delete(route('posts.destroy', [selectedPost.id]), {
            onSuccess: () => {
                mode = 'create';
                selectedPost = null;
            }
        });
    }
};

defineProps({
    posts: {
        type: Object,
    },
});
</script>

<template>
    <AppLayout title="Posts">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Posts
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 sm:px-6 lg:px-8">
                        <div class="sm:flex sm:items-center">
                            <div class="sm:flex-auto pt-5">
                                <h1 class="text-xl font-semibold text-gray-900">List Posts</h1>
                                <p class="mt-2 text-sm text-gray-700">A list of all the Posts.</p>
                            </div>
                            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                                <jet-primary-button v-if="can('post-create')" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto" @click="openModal('create')">Add Post</jet-primary-button>
                            </div>
                        </div>
                        <div class="mt-8 flex flex-col">
                            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle">
                                    <div class="overflow-hidden shadow-sm ring-1 ring-black ring-opacity-5">
                                        <table class="min-w-full divide-y divide-gray-300">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Id</th>
                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Created at</th>
                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Updated at</th>
                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200 bg-white">
                                                <tr v-for="post in posts" :key="post.id">
                                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ post.id }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ post.name }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ post.created_at }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ post.updated_at }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        <jet-primary-button v-if="can('post-show')" class="inline-flex items-center justify-center rounded-md border border-transparent bg-yellow-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto mr-1" @click="openModal('show', post)">Show</jet-primary-button>
                                                        <jet-primary-button v-if="can('post-edit')" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto mr-1" @click="openModal('edit', post)">Edit</jet-primary-button>
                                                        <jet-primary-button v-if="can('post-destroy')" class="inline-flex items-center justify-center rounded-md border border-transparent bg-red-400 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto" @click="mode = 'delete'; selectedPost = post; submit()">Delete</jet-primary-button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <jet-modal :show="acting" @close="acting = false">
            <div class="bg-gray-50 shadow-2xl p-8">
                <h2 class="text-gray-600 text-2xl font-extrabold text-center">Create a Post</h2>
                <form class="flex flex-col items-center p-16" @submit.prevent="submit">
                    <jet-text-input class="px-5 py-3 w-96 border border-gray-600 rounded" type="text"
                        name="name" placeholder="Post" v-model="form.name"></jet-text-input>
                    <jet-input-error :message="form.errors.name" class="mt-2" />

                    <jet-primary-button
                        class="px-5 py-3 mt-5 w-96 bg-indigo-600 hover:bg-indigo-700 justify-center rounded-xl text-sm"
                        :disabled="form.processing">
                        <span class="animate-spin mr-1" v-show="form.processing">&#9696;</span>
                        <span v-show="!form.processing">Save</span>
                    </jet-primary-button>
                </form>
            </div>
        </jet-modal> -->
        <jet-modal :show="acting" @close="acting = false">
            <div class="bg-gray-50 shadow-2xl p-8">
                <h2 class="text-gray-600 text-2xl font-extrabold text-center" v-if="mode === 'create'">Create a Post</h2>
                <h2 class="text-gray-600 text-2xl font-extrabold text-center" v-else-if="mode === 'show'">Show Post</h2>
                <h2 class="text-gray-600 text-2xl font-extrabold text-center" v-else-if="mode === 'edit'">Edit Post</h2>
                <div v-if="mode === 'show'" class="flex flex-col items-center p-16">
                    <p class="text-gray-600">Name: {{ selectedPost.name }}</p>
                    <!-- Add other post details here -->
                </div>
                <form v-else class="flex flex-col items-center p-16" @submit.prevent="submit">
                    <jet-text-input class="px-5 py-3 w-96 border border-gray-600 rounded" type="text"
                        name="name" placeholder="Post" v-model="form.name"></jet-text-input>
                    <jet-input-error :message="form.errors.name" class="mt-2" />

                    <jet-primary-button
                        class="px-5 py-3 mt-5 w-96 bg-indigo-600 hover:bg-indigo-700 justify-center rounded-xl text-sm"
                        :disabled="form.processing">
                        <span class="animate-spin mr-1" v-show="form.processing">&#9696;</span>
                        <span v-show="!form.processing">Save</span>
                    </jet-primary-button>
                </form>
            </div>
        </jet-modal>
    </AppLayout>
</template>
