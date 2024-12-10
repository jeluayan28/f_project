<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div class="flex items-center justify-center min-h-screen bg-gray-50">
            <div class="w-full max-w-md">
                <div class="text-center mb-8">
                    <div
                        class="flex items-center justify-center space-x-3 mb-4"
                    >
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
                    <h2 class="text-3xl font-semibold text-gray-800">
                        Log in to your account
                    </h2>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-md">
                    <div
                        v-if="status"
                        class="mb-4 text-sm font-medium text-green-600"
                    >
                        {{ status }}
                    </div>

                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <InputLabel
                                for="email"
                                value="Email"
                                class="text-gray-700"
                            />
                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.email"
                            />
                        </div>

                        <div class="mb-4">
                            <InputLabel
                                for="password"
                                value="Password"
                                class="text-gray-700"
                            />
                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.password"
                            />
                        </div>

                        <div class="mb-4 flex items-center">
                            <Checkbox
                                name="remember"
                                v-model:checked="form.remember"
                                class="rounded text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                            />
                            <span class="ml-2 text-sm text-gray-600"
                                >Remember me</span
                            >
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-sm text-green-600 hover:text-green-800 transition duration-150 ease-in-out"
                            >
                                Forgot your password?
                            </Link>

                            <PrimaryButton
                                class="bg-green-600 hover:bg-green-700 focus:ring-green-500"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Log in
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
