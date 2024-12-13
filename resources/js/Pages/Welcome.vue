<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>
    <Head title="Welcome to Agusan del Norte Adventures" />
    <div class="min-h-screen bg-gray-50 text-gray-800 font-sans">
        <div class="relative flex min-h-screen flex-col">
            <header class="bg-white shadow-sm">
                <nav class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <svg
                                class="w-10 h-10 text-green-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                ></path>
                            </svg>
                            <span class="text-2xl font-bold text-green-700"
                                >Wanderlust</span
                            >
                        </div>
                        <div v-if="canLogin" class="space-x-4">
                            <Link
                                v-if="$page.props.auth.user"
                                :href="route('dashboard')"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                            >
                                Dashboard
                            </Link>

                            <template v-else>
                                <Link
                                    :href="route('login')"
                                    class="inline-flex items-center px-4 py-2 border border-green-300 text-sm font-medium rounded-md text-green-700 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                >
                                    Log in
                                </Link>

                                <Link
                                    v-if="canRegister"
                                    :href="route('register')"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                >
                                    Register
                                </Link>
                            </template>
                        </div>
                    </div>
                </nav>
            </header>

            <main
                class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-16"
            >
                <div class="text-center max-w-4xl mx-auto">
                    <h1
                        class="text-xl md:text-7xl font-serif text-green-800 mb-8 leading-tight tracking-wide"
                    >
                        Discover the Beauty of Agusan del Norte
                    </h1>
                    <p
                        class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto font-light"
                    >
                        Embark on unforgettable journeys, explore breathtaking
                        landscapes, and immerse yourself in the rich culture of
                        Agusan del Norte.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img
                            src="/images/AgusanMarsh.png"
                            alt="Agusan Marsh"
                            class="w-full h-48 object-cover"
                        />
                        <div class="p-6">
                            <h3
                                class="text-xl font-semibold text-gray-800 mb-2"
                            >
                                Agusan Marsh
                            </h3>
                            <p class="text-gray-600">
                                Experience the largest marshland in the
                                Philippines, home to diverse wildlife and
                                floating communities.
                            </p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img
                            src="/images/CBR.jpg"
                            alt="Cabadbaran City"
                            class="w-full h-48 object-cover"
                        />
                        <div class="p-6">
                            <h3
                                class="text-xl font-semibold text-gray-800 mb-2"
                            >
                                Cabadbaran City
                            </h3>
                            <p class="text-gray-600">
                                Explore the capital city of Agusan del Norte,
                                known for its historical sites and natural
                                attractions.
                            </p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img
                            src="/images/WL3.jpg"
                            alt="Mount Hilong-Hilong"
                            class="w-full h-48 object-cover"
                        />
                        <div class="p-6">
                            <h3
                                class="text-xl font-semibold text-gray-800 mb-2"
                            >
                                Mount Hilong-Hilong
                            </h3>
                            <p class="text-gray-600">
                                Embark on a challenging hike to one of the
                                highest peaks in Mindanao, offering breathtaking
                                views.
                            </p>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="bg-green-800 text-white">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="text-center text-sm">
                        <p>
                            &copy; {{ new Date().getFullYear() }} Wanderlust.
                            All rights reserved.
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>
