<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ touristSpot.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-2">
                                Tourist Spot Name
                            </h3>
                            <p>{{ touristSpot.name }}</p>
                        </div>
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-2">Location</h3>
                            <p>{{ touristSpot.location }}</p>
                        </div>
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-2">
                                Description
                            </h3>
                            <p>{{ touristSpot.description }}</p>
                        </div>
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-2">Rating</h3>
                            <p>{{ touristSpot.rating }} / 5</p>
                        </div>
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-2">Category</h3>
                            <p>{{ touristSpot.category.name }}</p>
                        </div>
                        <div class="flex space-x-4">
                            <Link
                                :href="route('spot.edit', touristSpot.spot_id)"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            >
                                Edit
                            </Link>
                            <Link
                                :href="route('spot.index')"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                            >
                                Back to List
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/vue3";

// Define props
const props = defineProps({
    touristSpot: Object,
});
</script>
