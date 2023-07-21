<script setup>
import Logo from "@/Components/Images/stoword_logo.png";
import { Head, Link, router } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    isAuth: {
        type: Boolean,
    },
});
</script>

<template>
    <Head title="Home" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
    >
        <div class="fixed top-6 right-6">
            <div v-if="!isAuth">
                <Link
                    :href="route('login')"
                    class="font-semibold uppercase text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Sign in</Link
                >
                <PrimaryButton
                    v-if="canRegister"
                    @click="router.visit(route('register'))"
                    class="ml-4"
                >
                    Sign up
                </PrimaryButton>
            </div>
            <PrimaryButton
                v-else
                @click="router.visit(route('app'))"
                class="ml-4"
            >
                Get Started
            </PrimaryButton>
        </div>
        <div class="w-full mx-auto p-6 lg:p-8">
            <div class="flex flex-col items-center justify-center space-y-7">
                <img :src="Logo" alt="Logo" class="max-w-xs" />
                <div class="w-full" v-if="canLogin">
                    <div class="flex flex-col items-center space-y-5">
                        <div
                            class="w-1/2 space-y-5 dark:text-gray-200 text-gray-800 text-md text-center"
                        >
                            <p>
                                With just a few taps, you can
                                <span class="highlight decoration-primary"
                                    >generate sentences in English</span
                                >
                                by entering a
                                <span class="highlight decoration-primary"
                                    >word or phrasal verb</span
                                >. Whether you're a student, writer, or language
                                enthusiast, this app can help you
                                <span class="highlight decoration-primary"
                                    >improve your vocabulary</span
                                >
                                and grammar skills.
                            </p>
                            <div class="aspect-w-16 aspect-h-9">
                                <iframe
                                    src="https://www.youtube-nocookie.com/embed/RYuKoLVWXSY?controls=0&autoplay=1"
                                    title="YouTube video player"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen
                                ></iframe>
                            </div>
                            <p>
                                You can choose to generate up to
                                <span class="highlight decoration-secondary"
                                    >three sentences</span
                                >
                                and select the
                                <span class="highlight decoration-secondary"
                                    >English sentence level</span
                                >. Additionally, the app provides links for word
                                meanings, pronunciations, and translations to
                                assist you with your studies. With Stoword,
                                creating
                                <span class="highlight decoration-secondary"
                                    >well-crafted sentences</span
                                >
                                has never been easier!
                            </p>
                        </div>
                    </div>
                </div>
                <footer
                    class="text-gray-400 dark:text-gray-600 text-center text-sm"
                >
                    <div>
                        © 2023 ·
                        <a
                            href="https://github.com/lauroguedes/stoword"
                            class="underline hover:opacity-90"
                            >Stoword Project</a
                        >
                        by
                        <a
                            class="underline hover:opacity-90"
                            href="https://github.com/lauroguedes"
                            target="_blank"
                            >Lauro Guedes</a
                        >
                    </div>
                    <div>MIT License</div>
                </footer>
            </div>
        </div>
    </div>
</template>

<style scoped>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
