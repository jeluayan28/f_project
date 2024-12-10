<template>
    <AuthenticatedLayout title="Edit Tourist Spot">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Tourist Spot
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <label
                                    class="block text-gray-700 text-sm font-bold mb-2"
                                    for="name"
                                >
                                    Name
                                </label>
                                <input
                                    v-model="form.name"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="name"
                                    type="text"
                                    placeholder="Tourist Spot Name"
                                />
                            </div>
                            <div class="mb-4">
                                <label
                                    class="block text-gray-700 text-sm font-bold mb-2"
                                    for="location"
                                >
                                    Location
                                </label>
                                <input
                                    v-model="form.location"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="location"
                                    type="text"
                                    placeholder="Location"
                                />
                            </div>
                            <div class="mb-4">
                                <label
                                    class="block text-gray-700 text-sm font-bold mb-2"
                                    for="description"
                                >
                                    Description
                                </label>
                                <textarea
                                    v-model="form.description"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="description"
                                    placeholder="Description"
                                ></textarea>
                            </div>
                            <div class="mb-4">
                                <label
                                    class="block text-gray-700 text-sm font-bold mb-2"
                                    for="rating"
                                >
                                    Rating
                                </label>
                                <input
                                    v-model="form.rating"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="rating"
                                    type="number"
                                    min="0"
                                    max="5"
                                    step="0.1"
                                    placeholder="Rating"
                                />
                            </div>
                            <div class="mb-4">
                                <label
                                    class="block text-gray-700 text-sm font-bold mb-2"
                                    for="category_id"
                                >
                                    Category
                                </label>
                                <select
                                    v-model="form.category_id"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="category_id"
                                >
                                    <option value="">Select a category</option>
                                    <option
                                        v-for="category in categories"
                                        :key="category.category_id"
                                        :value="category.category_id"
                                    >
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="flex items-center justify-between">
                                <button
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                    type="submit"
                                >
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
