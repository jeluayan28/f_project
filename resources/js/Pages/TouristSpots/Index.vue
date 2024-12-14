<template>
    <AuthenticatedLayout title="Tourist Spots">
        <template #header>
            <div
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 bg-gradient-to-r from-green-600 to-green-800 rounded-lg shadow-lg"
            >
                <div
                    class="flex flex-col sm:flex-row items-center justify-between"
                >
                    <h2 class="text-3xl font-bold text-white mb-4 sm:mb-0">
                        Tourist Spots
                    </h2>
                    <div
                        class="w-full sm:w-auto flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4"
                    >
                        <!-- Search Bar -->
                        <div class="relative w-full sm:w-64">
                            <input
                                v-model="searchQuery"
                                @keyup.enter="performSearch"
                                type="text"
                                placeholder="Search..."
                                class="w-full border-2 border-green-300 rounded-full px-4 py-2 pl-10 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400"
                            />
                            <svg
                                id="Search_24"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-black w-4 h-4"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                            >
                                <rect
                                    width="24"
                                    height="24"
                                    stroke="none"
                                    fill="none"
                                    opacity="0"
                                />
                                <g transform="matrix(0.46 0 0 0.46 12 12)">
                                    <path
                                        style="fill: currentColor"
                                        transform="translate(-25.45, -24.95)"
                                        d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z"
                                        stroke-linecap="round"
                                    />
                                </g>
                            </svg>
                        </div>

                        <!-- Category Buttons -->
                        <div class="flex flex-wrap justify-center gap-2">
                            <button
                                @click="fetchBeach"
                                class="flex items-center px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-300 ease-in-out transform hover:scale-105"
                            >
                                <svg
                                    id="Beach_24"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                >
                                    <rect
                                        width="24"
                                        height="24"
                                        stroke="none"
                                        fill="#000000"
                                        opacity="0"
                                    />

                                    <g transform="matrix(0.4 0 0 0.4 12 12)">
                                        <path
                                            style="
                                                stroke: none;
                                                stroke-width: 1;
                                                stroke-dasharray: none;
                                                stroke-linecap: butt;
                                                stroke-dashoffset: 0;
                                                stroke-linejoin: miter;
                                                stroke-miterlimit: 4;
                                                fill: rgb(255, 255, 255);
                                                fill-rule: nonzero;
                                                opacity: 1;
                                            "
                                            transform=" translate(-25.01, -25)"
                                            d="M 18.53125 0 C 11.820313 0 7 5.753906 7 13.09375 C 10.25 5.4375 19.910156 4.523438 24 8.71875 C 16.660156 7.878906 7 11.429688 7 21.5 C 7 25.273438 7.847656 28.746094 10.15625 33.46875 C 11.9375 17 24.101563 14.359375 29.03125 13.625 C 38.367188 13.625 45.589844 20.652344 44.75 33.34375 C 48.210938 28.832031 50 25.785156 50 21.90625 C 50 12.046875 35.40625 8.503906 30.6875 9.65625 C 31.210938 8.609375 33.738281 6.386719 37.09375 6.28125 C 40.238281 6.28125 45.167969 7.664063 48.3125 11.125 C 46.949219 2.523438 43.089844 0 39 0 C 33.859375 0 29.03125 4.09375 29.03125 4.09375 C 26.199219 1.050781 21.675781 0 18.53125 0 Z M 29.15625 15.625 C 27.664063 15.855469 26.300781 16.203125 25 16.625 C 24.628906 36.617188 15.71875 43.25 10.46875 45.4375 C 12.101563 45.765625 13.957031 46 16 46 C 19.527344 46 22.585938 45.011719 25.5625 44.0625 C 26.558594 43.746094 27.589844 43.445313 28.625 43.15625 C 31.421875 35.464844 31.941406 22.855469 32 15.90625 C 31.097656 15.730469 30.132813 15.632813 29.15625 15.625 Z M 1.0625 44 C 0.882813 43.988281 0.695313 44.039063 0.53125 44.125 C 0.203125 44.296875 0 44.628906 0 45 L 0 49 C 0 49.554688 0.449219 50 1 50 L 49 50 C 49.4375 50 49.839844 49.703125 49.96875 49.28125 C 50.097656 48.859375 49.925781 48.433594 49.5625 48.1875 C 49.308594 48.015625 43.320313 44 36 44 C 32.378906 44 29.234375 44.996094 26.1875 45.96875 C 23.070313 46.964844 19.835938 48 16 48 C 7.160156 48 1.617188 44.226563 1.5625 44.1875 C 1.410156 44.082031 1.242188 44.011719 1.0625 44 Z"
                                            stroke-linecap="round"
                                        />
                                    </g>
                                </svg>
                            </button>
                            <button
                                @click="fetchHeritage"
                                class="flex items-center px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-300 ease-in-out transform hover:scale-105"
                            >
                                <svg
                                    id="Museum_24"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                >
                                    <rect
                                        width="24"
                                        height="24"
                                        stroke="none"
                                        fill="#000000"
                                        opacity="0"
                                    />

                                    <g transform="matrix(1.08 0 0 1.08 12 12)">
                                        <path
                                            style="
                                                stroke: none;
                                                stroke-width: 1;
                                                stroke-dasharray: none;
                                                stroke-linecap: butt;
                                                stroke-dashoffset: 0;
                                                stroke-linejoin: miter;
                                                stroke-miterlimit: 4;
                                                fill: rgb(255, 255, 255);
                                                fill-rule: nonzero;
                                                opacity: 1;
                                            "
                                            transform=" translate(-12, -11.75)"
                                            d="M 12 2.5 L 3 6.5 L 3 9 L 5 9 L 5 17 L 7 17 L 7 9 L 9 9 L 9 17 L 11 17 L 11 9 L 13 9 L 13 17 L 15 17 L 15 9 L 17 9 L 17 17 L 19 17 L 19 9 L 21 9 L 21 6.5 L 12 2.5 z M 12 4.6894531 L 17.201172 7 L 6.7988281 7 L 12 4.6894531 z M 3 19 L 3 21 L 21 21 L 21 19 L 3 19 z"
                                            stroke-linecap="round"
                                        />
                                    </g>
                                </svg>
                            </button>
                            <button
                                @click="fetchMountain"
                                class="flex items-center px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-300 ease-in-out transform hover:scale-105"
                            >
                                <svg
                                    id="Rocky_Mountain_24"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                >
                                    <rect
                                        width="24"
                                        height="24"
                                        stroke="none"
                                        fill="#000000"
                                        opacity="0"
                                    />

                                    <g transform="matrix(0.85 0 0 0.85 12 12)">
                                        <path
                                            style="
                                                stroke: none;
                                                stroke-width: 1;
                                                stroke-dasharray: none;
                                                stroke-linecap: butt;
                                                stroke-dashoffset: 0;
                                                stroke-linejoin: miter;
                                                stroke-miterlimit: 4;
                                                fill: rgb(255, 255, 255);
                                                fill-rule: evenodd;
                                                opacity: 1;
                                            "
                                            transform=" translate(-12, -12)"
                                            d="M 12.1413 2.11112 C 12.0006 1.87904 11.7445 1.74007 11.4712 1.75055 C 11.1846 1.76156 10.9294 1.93504 10.8137 2.19748 L 7.41356 9.91091 L 10.0222 8.70941 C 10.3984 8.53612 10.8439 8.70064 11.0172 9.07686 C 11.1904 9.45309 11.0259 9.89855 10.6497 10.0718 L 5.02268 12.6636 L 10.0432 22.2501 L 11.394 22.2501 L 14.3708 15.1476 C 14.436 14.992 14.5517 14.863 14.6993 14.7813 L 21.3619 11.0931 L 17.601 4.14306 C 17.5027 3.96145 17.3339 3.82839 17.1344 3.77526 C 16.9348 3.72212 16.7222 3.75361 16.5466 3.8623 L 15.224 4.6811 L 16.4075 6.87912 C 16.6039 7.24383 16.4674 7.69867 16.1027 7.89505 C 15.738 8.09143 15.2832 7.95498 15.0868 7.59027 L 13.9462 5.47207 L 13.9442 5.47336 L 13.376 4.41304 L 12.1756 2.1837 C 12.1627 2.15986 12.1513 2.13563 12.1413 2.11112 Z M 21.8764 12.5228 L 16.0364 15.7556 L 19.0449 22.2502 L 23 22.2502 C 23.226 22.2502 23.44 22.1483 23.5824 21.9728 C 23.7248 21.7973 23.7805 21.5669 23.7339 21.3457 L 21.8764 12.5228 Z M 17.3918 22.2502 L 15.0968 17.2959 L 13.0204 22.2501 L 17.3918 22.2502 Z M 0.32918 21.1646 L 3.96903 13.8849 L 8.34994 22.2501 L 0.999993 22.25 C 0.740061 22.25 0.498664 22.1154 0.362011 21.8943 C 0.225358 21.6732 0.212935 21.3971 0.32918 21.1646 Z"
                                            stroke-linecap="round"
                                        />
                                    </g>
                                </svg>
                            </button>
                            <button
                                @click="fetchRatings"
                                class="flex items-center px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-300 ease-in-out transform hover:scale-105"
                            >
                                <svg
                                    id="Rating_24"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                >
                                    <rect
                                        width="24"
                                        height="24"
                                        stroke="none"
                                        fill="#000000"
                                        opacity="0"
                                    />

                                    <g transform="matrix(0.48 0 0 0.48 12 12)">
                                        <path
                                            style="
                                                stroke: none;
                                                stroke-width: 1;
                                                stroke-dasharray: none;
                                                stroke-linecap: butt;
                                                stroke-dashoffset: 0;
                                                stroke-linejoin: miter;
                                                stroke-miterlimit: 4;
                                                fill: rgb(255, 255, 255);
                                                fill-rule: nonzero;
                                                opacity: 1;
                                            "
                                            transform=" translate(-25, -25)"
                                            d="M 41 4 L 9 4 C 6.24 4 4 6.24 4 9 L 4 41 C 4 43.76 6.24 46 9 46 L 41 46 C 43.76 46 46 43.76 46 41 L 46 9 C 46 6.24 43.76 4 41 4 z M 33.01 37 L 25 31.75 L 16.99 37 L 19.38 27.65 L 12 21.56 L 21.57 21.029999999999998 L 25 12 L 28.43 21.03 L 38 21.56 L 30.62 27.65 L 33.01 37 z"
                                            stroke-linecap="round"
                                        />
                                    </g>
                                </svg>
                            </button>
                            <button
                                @click="reset"
                                class="flex items-center px-4 py-2 bg-yellow-400 text-white rounded-full hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition duration-300 ease-in-out transform hover:scale-105"
                            >
                                <svg
                                    id="Sort_By_Recently_Viewed_24"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                >
                                    <rect
                                        width="24"
                                        height="24"
                                        stroke="none"
                                        fill="#000000"
                                        opacity="0"
                                    />

                                    <g transform="matrix(0.43 0 0 0.43 12 12)">
                                        <path
                                            style="
                                                stroke: none;
                                                stroke-width: 1;
                                                stroke-dasharray: none;
                                                stroke-linecap: butt;
                                                stroke-dashoffset: 0;
                                                stroke-linejoin: miter;
                                                stroke-miterlimit: 4;
                                                fill: rgb(255, 255, 255);
                                                fill-rule: nonzero;
                                                opacity: 1;
                                            "
                                            transform=" translate(-25, -25.92)"
                                            d="M 2 3 L 2 33 C 2 34.105469 2.894531 35 4 35 L 23 35 L 23 41.1875 L 21.40625 39.59375 C 21.03125 39.199219 20.511719 38.972656 19.96875 38.96875 C 19.15625 38.976563 18.429688 39.472656 18.128906 40.226563 C 17.824219 40.980469 18.011719 41.839844 18.59375 42.40625 L 23.59375 47.40625 L 25 48.84375 L 26.40625 47.40625 L 31.40625 42.40625 C 32.003906 41.925781 32.273438 41.148438 32.101563 40.402344 C 31.929688 39.652344 31.347656 39.070313 30.597656 38.898438 C 29.851563 38.726563 29.074219 38.996094 28.59375 39.59375 L 27 41.1875 L 27 35 L 46 35 C 47.105469 35 48 34.105469 48 33 L 48 3 L 44 3 L 44 31 L 25.375 31 C 25.242188 30.976563 25.105469 30.964844 24.96875 30.96875 C 24.832031 30.964844 24.695313 30.976563 24.5625 31 L 6 31 L 6 3 Z M 25 10 C 15.679688 10 10.40625 17.101563 10.1875 17.40625 L 9.75 18 L 10.21875 18.59375 C 10.449219 18.894531 15.941406 26 25 26 C 34.058594 26 39.550781 18.894531 39.78125 18.59375 L 40.25 18 L 39.8125 17.40625 C 39.59375 17.101563 34.320313 10 25 10 Z M 25 14 C 27.210938 14 29 15.789063 29 18 C 29 20.210938 27.210938 22 25 22 C 22.789063 22 21 20.210938 21 18 C 21 15.789063 22.789063 14 25 14 Z"
                                            stroke-linecap="round"
                                        />
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <div class="py-12 bg-green-50">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div
                            v-if="
                                $page.props.user.role_id === 2 ||
                                $page.props.user.role_id === 3
                            "
                            class="mb-6"
                        >
                            <Link
                                :href="route('spot.create')"
                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:scale-105 inline-flex items-center"
                            >
                                <i class="fas fa-plus mr-2"></i>
                                Add New Tourist Spot
                            </Link>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-green-500 text-white">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"
                                        >
                                            Name
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"
                                        >
                                            Location
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"
                                        >
                                            Rating
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"
                                        >
                                            Category
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"
                                        >
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr
                                        v-for="spot in touristSpots"
                                        :key="spot.spot_id"
                                        class="hover:bg-green-50"
                                    >
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <Link
                                                :href="
                                                    route(
                                                        'spot.show',
                                                        spot.spot_id
                                                    )
                                                "
                                                class="text-green-600 hover:text-green-900 font-medium"
                                            >
                                                {{ spot.name }}
                                            </Link>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ spot.location }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span
                                                    class="text-yellow-500 mr-1"
                                                    ><i class="fas fa-star"></i
                                                ></span>
                                                {{ spot.rating }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                                            >
                                                {{ spot.category.name }}
                                            </span>
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                                        >
                                            <Link
                                                v-if="
                                                    $page.props.user.role_id ===
                                                        2 ||
                                                    $page.props.user.role_id ===
                                                        3
                                                "
                                                :href="
                                                    route(
                                                        'spot.edit',
                                                        spot.spot_id
                                                    )
                                                "
                                                class="text-indigo-600 hover:text-indigo-900 mr-2"
                                            >
                                                <i class="fas fa-edit"></i> Edit
                                            </Link>

                                            <Link
                                                :href="
                                                    route(
                                                        'spot.show',
                                                        spot.spot_id
                                                    )
                                                "
                                                class="text-indigo-600 hover:text-indigo-900 mr-2"
                                            >
                                                Show Details
                                            </Link>

                                            <button
                                                v-if="
                                                    $page.props.user.role_id ===
                                                    3
                                                "
                                                @click="
                                                    deleteSpot(spot.spot_id)
                                                "
                                                class="text-red-600 hover:text-red-900"
                                            >
                                                <i class="fas fa-trash-alt"></i>
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
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from "vue";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link, router } from "@inertiajs/vue3";

const props = defineProps({
    touristSpots: Array,
});

const searchQuery = ref("");

const deleteSpot = (id) => {
    if (confirm("Are you sure you want to delete this tourist spot?")) {
        router.delete(
            route("spot.destroy", id),
            {},
            {
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => {},
                onError: (errors) => {
                    alert(
                        errors.error ||
                            "An error occurred while deleting the tourist spot."
                    );
                },
            }
        );
    }
};

const performSearch = () => {
    router.get(
        route("spot.index"),
        { search: searchQuery.value },
        {
            preserveState: true,
            preserveScroll: true,
        }
    );
};

const fetchRatings = () => {
    router.get(route("spot.rating"));
};

const fetchBeach = () => {
    router.get(route("spot.beach"));
};

const fetchHeritage = () => {
    router.get(route("spot.heritage"));
};

const fetchMountain = () => {
    router.get(route("spot.mountain"));
};

const reset = () => {
    router.get(route("spot.index"));
};
</script>
