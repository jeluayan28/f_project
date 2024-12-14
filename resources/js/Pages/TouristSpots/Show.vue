<template>
    <AuthenticatedLayout>
        <template #header>
            <div
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 bg-gradient-to-r from-green-600 to-green-800 rounded-lg shadow-lg"
            >
                <h2 class="text-3xl font-bold text-white">
                    {{ touristSpot.name }}
                </h2>
            </div>
        </template>

        <div class="py-12 bg-green-50">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl">
                    <div class="p-8 bg-white border-b border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-6">
                                <div>
                                    <h3
                                        class="text-lg font-semibold text-green-700 mb-2"
                                    >
                                        Tourist Spot Name
                                    </h3>
                                    <p
                                        class="text-xl font-medium text-gray-800"
                                    >
                                        {{ touristSpot.name }}
                                    </p>
                                </div>
                                <div>
                                    <h3
                                        class="text-lg font-semibold text-green-700 mb-2"
                                    >
                                        Location
                                    </h3>
                                    <p class="text-gray-600">
                                        {{ touristSpot.location }}
                                    </p>
                                </div>
                                <div>
                                    <h3
                                        class="text-lg font-semibold text-green-700 mb-2"
                                    >
                                        Rating
                                    </h3>
                                    <div class="flex items-center">
                                        <span
                                            class="text-2xl font-bold text-yellow-500 mr-2"
                                            >{{ touristSpot.rating }}</span
                                        >
                                        <div class="flex">
                                            <svg
                                                v-for="i in 5"
                                                :key="i"
                                                class="h-5 w-5"
                                                :class="
                                                    i <=
                                                    Math.round(
                                                        touristSpot.rating
                                                    )
                                                        ? 'text-yellow-400'
                                                        : 'text-gray-300'
                                                "
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-6">
                                <div>
                                    <h3
                                        class="text-lg font-semibold text-green-700 mb-2"
                                    >
                                        Category
                                    </h3>
                                    <span
                                        class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800"
                                    >
                                        {{ touristSpot.category.name }}
                                    </span>
                                </div>
                                <div>
                                    <h3
                                        class="text-lg font-semibold text-green-700 mb-2"
                                    >
                                        Description
                                    </h3>
                                    <p class="text-gray-600">
                                        {{ touristSpot.description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8 flex space-x-4">
                            <Link
                                v-if="
                                    $page.props.user.role_id === 2 ||
                                    $page.props.user.role_id === 3
                                "
                                :href="route('spot.edit', touristSpot.spot_id)"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-300 ease-in-out"
                            >
                                <svg
                                    class="mr-2 h-5 w-5"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                    />
                                </svg>
                                Edit
                            </Link>
                            <Link
                                :href="route('spot.index')"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-300 ease-in-out"
                            >
                                <svg
                                    class="mr-2 h-5 w-5 text-gray-500"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
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
