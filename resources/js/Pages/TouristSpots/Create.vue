<template>
    <AuthenticatedLayout title="Create Tourist Spot">
        <template #header>
            <div
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 bg-gradient-to-r from-green-600 to-green-800 rounded-lg shadow-lg"
            >
                <h2 class="text-3xl font-bold text-white">
                    Create Tourist Spot
                </h2>
            </div>
        </template>

        <div class="py-12 bg-green-50">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl">
                    <div class="p-8 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit" class="space-y-6">
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <label
                                        for="name"
                                        class="block text-sm font-medium text-gray-700 mb-1"
                                    >
                                        Name
                                    </label>
                                    <input
                                        v-model="form.name"
                                        id="name"
                                        type="text"
                                        maxlength="20"
                                        placeholder="Tourist Spot Name"
                                        class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                    />
                                </div>
                                <div>
                                    <label
                                        for="location"
                                        class="block text-sm font-medium text-gray-700 mb-1"
                                    >
                                        Location
                                    </label>
                                    <input
                                        v-model="form.location"
                                        id="location"
                                        type="text"
                                        placeholder="Location"
                                        class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                    />
                                </div>
                            </div>
                            <div>
                                <label
                                    for="description"
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                >
                                    Description
                                </label>
                                <textarea
                                    v-model="form.description"
                                    id="description"
                                    rows="4"
                                    maxlength="100"
                                    placeholder="Describe the tourist spot"
                                    class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                ></textarea>
                            </div>
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <label
                                        for="rating"
                                        class="block text-sm font-medium text-gray-700 mb-1"
                                    >
                                        Rating
                                    </label>
                                    <div class="relative rounded-md shadow-sm">
                                        <input
                                            v-model="form.rating"
                                            id="rating"
                                            type="number"
                                            min="0"
                                            max="5"
                                            step="0.1"
                                            placeholder="Rating"
                                            class="block w-full px-4 py-3 rounded-md border-gray-300 focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        />
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none"
                                        >
                                            <span
                                                class="text-gray-500 sm:text-sm"
                                                >/5</span
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label
                                        for="category_id"
                                        class="block text-sm font-medium text-gray-700 mb-1"
                                    >
                                        Category
                                    </label>
                                    <select
                                        v-model="form.category_id"
                                        id="category_id"
                                        class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                    >
                                        <option value="">
                                            Select a category
                                        </option>
                                        <option
                                            v-for="category in categories"
                                            :key="category.category_id"
                                            :value="category.category_id"
                                        >
                                            {{ category.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex items-center justify-end">
                                <button
                                    type="submit"
                                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-300 ease-in-out transform hover:scale-105"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 mr-2"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    Create Tourist Spot
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    location: "",
    description: "",
    rating: "",
    category_id: "",
});

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
});

const submit = () => {
    form.post(route("spot.store"));
};
</script>
