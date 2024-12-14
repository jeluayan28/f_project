<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="flex items-center justify-center h-[calc(100vh-64px)]">
            <div class="w-full">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <!-- CTA Section -->
                    <div
                        class="bg-gradient-to-r from-green-600 to-green-800 rounded-lg shadow-md p-8 text-center"
                    >
                        <h2 class="text-3xl font-bold text-white mb-4">
                            Embark on a Journey!
                        </h2>
                        <p class="text-xl text-green-100 mb-6">
                            Step Into the Heart of Agusan del Norte and
                            Experience Its Natural Wonders
                        </p>

                        <Link
                            :href="route('spot.index')"
                            class="inline-block bg-white text-green-600 font-bold py-3 px-8 rounded-full hover:bg-green-100 transition duration-300"
                        >
                            Click Here!
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
