<template>
    <AuthenticatedLayout title="Tourist Spots">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tourist Spots
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-4">
                            <Link
                                :href="route('spot.create')"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            >
                                Add New Tourist Spot
                            </Link>
                        </div>
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Name
                                    </th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Location
                                    </th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Rating
                                    </th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Category
                                    </th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="spot in touristSpots"
                                    :key="spot.spot_id"
                                >
                                    <td
                                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                    >
                                        <Link
                                            :href="
                                                route('spot.show', spot.spot_id)
                                            "
                                            class="text-blue-600 hover:text-blue-900"
                                        >
                                            {{ spot.name }}
                                        </Link>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                    >
                                        {{ spot.location }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                    >
                                        {{ spot.rating }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                    >
                                        {{ spot.category.name }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                    >
                                        <Link
                                            :href="
                                                route('spot.edit', spot.spot_id)
                                            "
                                            class="text-indigo-600 hover:text-indigo-900 mr-2"
                                            >Edit</Link
                                        >
                                        <button
                                            @click="deleteSpot(spot.spot_id)"
                                            class="text-red-600 hover:text-red-900"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    touristSpots: Array,
});

const deleteSpot = (id) => {
    if (confirm("Are you sure you want to delete this tourist spot?")) {
        this.$inertia.delete(route("spot.destroy", id));
    }
};
</script>
