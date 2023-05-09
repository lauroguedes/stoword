<template>
    <Head title="App" />
    <AuthAppLayout>
        <WordField />
    </AuthAppLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import AuthAppLayout from "@/Layouts/AuthAppLayout.vue";
import WordField from "@/Components/App/WordField.vue";
</script>
