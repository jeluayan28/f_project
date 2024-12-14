<template>
    <AuthenticatedLayout title="Edit Tourist Spot">
        <template #header>
            <div
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 bg-gradient-to-r from-green-600 to-green-800 rounded-lg shadow-lg"
            >
                <h2 class="text-3xl font-bold text-white">Edit Tourist Spot</h2>
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
                                        class="block text-sm font-medium text-gray-700 mb-1"
                                        for="name"
                                    >
                                        Name
                                    </label>
                                    <input
                                        v-model="form.name"
                                        class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        id="name"
                                        type="text"
                                        placeholder="Tourist Spot Name"
                                    />
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-1"
                                        for="location"
                                    >
                                        Location
                                    </label>
                                    <input
                                        v-model="form.location"
                                        class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        id="location"
                                        type="text"
                                        placeholder="Location"
                                    />
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                    for="description"
                                >
                                    Description
                                </label>
                                <textarea
                                    v-model="form.description"
                                    class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                    id="description"
                                    rows="4"
                                    placeholder="Describe the tourist spot"
                                ></textarea>
                            </div>
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-1"
                                        for="rating"
                                    >
                                        Rating
                                    </label>
                                    <div class="relative rounded-md shadow-sm">
                                        <input
                                            v-model="form.rating"
                                            class="block w-full px-4 py-3 rounded-md border-gray-300 focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                            id="rating"
                                            type="number"
                                            min="0"
                                            max="5"
                                            step="0.1"
                                            placeholder="Rating"
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
                                        class="block text-sm font-medium text-gray-700 mb-1"
                                        for="category_id"
                                    >
                                        Category
                                    </label>
                                    <select
                                        v-model="form.category_id"
                                        class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        id="category_id"
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
                                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-300 ease-in-out transform hover:scale-105"
                                    type="submit"
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
                                    Update Tourist Spot
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

const props = defineProps({
    touristSpot: Object,
    categories: Array,
});

const form = useForm({
    name: props.touristSpot.name,
    location: props.touristSpot.location,
    description: props.touristSpot.description,
    rating: props.touristSpot.rating,
    category_id: props.touristSpot.category_id,
});

const submit = () => {
    form.put(route("spot.update", { spot: props.touristSpot.spot_id }));
};
</script>
