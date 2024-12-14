<template>
    <AuthenticatedLayout title="Analytics">
        <template #header>
            <div
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 bg-gradient-to-r from-green-600 to-green-800 rounded-lg shadow-lg"
            >
                <div
                    class="flex flex-col sm:flex-row items-center justify-between"
                >
                    <h2 class="text-3xl font-bold text-white mb-4 sm:mb-0">
                        Admin Dashboard
                    </h2>
                    <button
                        @click="refreshMaterializedView"
                        class="flex items-center px-4 py-2 bg-white text-green-700 rounded-full hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-400 transition transform hover:scale-105 shadow-md"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-2"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        Refresh
                    </button>
                </div>
            </div>
        </template>

        <div
            class="py-12 bg-gradient-to-b from-green-50 to-white overflow-x-hidden"
        >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Category Summary -->
                    <div
                        class="w-full lg:w-1/2 bg-white overflow-hidden shadow-xl sm:rounded-lg p-6"
                    >
                        <h3
                            class="text-2xl font-bold mb-6 text-green-800 border-b-2 border-green-200 pb-2"
                        >
                            Category Summary
                        </h3>
                        <div v-if="statistics.length" class="space-y-4">
                            <div
                                v-for="(category, index) in visibleStatistics"
                                :key="category.category_name"
                                class="bg-gradient-to-r from-green-100 to-green-200 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1"
                            >
                                <h4
                                    class="font-bold text-xl text-green-700 mb-3"
                                >
                                    {{ category.category_name }}
                                </h4>
                                <p class="text-green-600">
                                    <span class="font-semibold"
                                        >Total Spots:</span
                                    >
                                    {{ category.total_spots }}
                                </p>
                                <p class="text-green-600">
                                    <span class="font-semibold"
                                        >Average Rating:</span
                                    >
                                    {{ category.average_rating }}
                                </p>
                                <p class="text-green-600">
                                    <span class="font-semibold"
                                        >Total Tourguides:</span
                                    >
                                    {{ category.total_tourguides }}
                                </p>
                            </div>
                        </div>
                        <p v-else class="text-green-600 text-center text-lg">
                            No category summary data available.
                        </p>
                        <div class="mt-6 flex justify-end">
                            <button
                                @click="nextCategory"
                                class="bg-green-600 text-white px-4 py-2 rounded-full hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-300 ease-in-out transform hover:scale-105"
                            >
                                Next
                            </button>
                        </div>
                    </div>

                    <!-- User-Defined Functions -->
                    <div
                        class="w-full lg:w-1/2 bg-white overflow-hidden shadow-xl sm:rounded-lg p-6"
                    >
                        <h3
                            class="text-2xl font-bold mb-6 text-green-800 border-b-2 border-green-200 pb-2"
                        >
                            User-Defined Functions
                        </h3>

                        <div class="space-y-8">
                            <div
                                class="bg-gradient-to-r from-green-50 to-green-100 p-6 rounded-lg shadow-md"
                            >
                                <h4
                                    class="font-bold text-xl text-green-700 mb-4"
                                >
                                    Average Rating for Tourguide
                                </h4>
                                <div
                                    class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4"
                                >
                                    <input
                                        v-model="tourguideNameForAvg"
                                        type="text"
                                        placeholder="Enter tourguide name"
                                        class="border-2 border-green-300 rounded-full px-4 py-2 w-full sm:w-auto focus:outline-none focus:ring-2 focus:ring-green-400"
                                    />
                                    <button
                                        @click="getAvgRatingForTourguide"
                                        class="bg-green-600 text-white px-6 py-2 rounded-full hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-300 ease-in-out transform hover:scale-105 w-full sm:w-auto"
                                    >
                                        Get Average
                                    </button>
                                </div>
                                <p
                                    v-if="avgRatingResult !== null"
                                    class="mt-4 text-lg font-semibold text-green-700"
                                >
                                    Average Rating: {{ avgRatingResult }}
                                </p>
                            </div>

                            <div
                                class="bg-gradient-to-r from-green-50 to-green-100 p-6 rounded-lg shadow-md"
                            >
                                <h4
                                    class="font-bold text-xl text-green-700 mb-4"
                                >
                                    Tourguide Spot List
                                </h4>
                                <div class="flex flex-col space-y-4 mb-4">
                                    <input
                                        v-model="tourguideNameForList"
                                        type="text"
                                        placeholder="Enter tourguide name"
                                        class="border-2 border-green-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                                    />
                                    <input
                                        v-model="categoryNameForList"
                                        type="text"
                                        placeholder="Enter category name"
                                        class="border-2 border-green-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                                    />
                                    <button
                                        @click="getTourguideSpotList"
                                        class="bg-green-600 text-white px-6 py-2 rounded-full hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-300 ease-in-out transform hover:scale-105 w-full sm:w-auto"
                                    >
                                        Get List
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tourguide Spot List Results -->
                <div
                    v-if="spotList.length || spotListFetched"
                    class="mt-8 bg-white overflow-hidden shadow-xl sm:rounded-lg p-6"
                >
                    <h4 class="font-bold text-xl text-green-700 mb-4">
                        Tourguide Spot List Results
                    </h4>
                    <div v-if="spotList.length" class="overflow-x-auto">
                        <table
                            class="w-full border-collapse bg-white shadow-md rounded-lg overflow-hidden"
                        >
                            <thead class="bg-green-600 text-white">
                                <tr>
                                    <th class="p-3 text-left">Spot Name</th>
                                    <th class="p-3 text-left">Location</th>
                                    <th class="p-3 text-left">Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="spot in spotList"
                                    :key="spot.spot_name"
                                    class="hover:bg-green-50"
                                >
                                    <td class="border-t p-3">
                                        {{ spot.spot_name }}
                                    </td>
                                    <td class="border-t p-3">
                                        {{ spot.location }}
                                    </td>
                                    <td class="border-t p-3">
                                        {{ spot.rating }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p
                        v-else-if="spotListFetched"
                        class="text-green-600 text-center text-lg mt-4"
                    >
                        No spots found for the given tourguide and category.
                    </p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, computed } from "vue";
import { router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    statistics: Array,
});

const tourguideNameForAvg = ref("");
const tourguideNameForList = ref("");
const categoryNameForList = ref("");
const avgRatingResult = ref(null);
const spotList = ref([]);
const spotListFetched = ref(false);

const currentCategoryIndex = ref(0);
const visibleStatistics = computed(() => {
    return props.statistics.slice(
        currentCategoryIndex.value,
        currentCategoryIndex.value + 1
    );
});

function nextCategory() {
    currentCategoryIndex.value =
        (currentCategoryIndex.value + 1) % props.statistics.length;
}

function refreshMaterializedView() {
    router.post(
        route("admin.refresh"),
        {},
        {
            preserveState: false,
            preserveScroll: true,
        }
    );
}

function getAvgRatingForTourguide() {
    router.get(
        route("admin.avgrating"),
        {
            TourGuideName: tourguideNameForAvg.value,
        },
        {
            preserveState: true,
            preserveScroll: true,
            only: ["avgRatingResult"],
            onSuccess: (page) => {
                let rawRating = page.props.avgRatingResult;
                avgRatingResult.value = parseFloat(rawRating).toFixed(2);
            },
        }
    );
}

function getTourguideSpotList() {
    router.get(
        route("admin.spotlist"),
        {
            TourGuideName: tourguideNameForList.value,
            Category: categoryNameForList.value,
        },
        {
            preserveState: true,
            preserveScroll: true,
            only: ["spotList", "spotListFetched"],
            onSuccess: (page) => {
                spotList.value = page.props.spotList || [];
                spotListFetched.value = true;
            },
        }
    );
}
</script>
