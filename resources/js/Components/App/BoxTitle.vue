<template>
    <h2 class="title">{{ text }}</h2>
</template>

<script setup>
    const props = defineProps({
        text: {
            type: String,
            required: true
        }
    })
</script>

<style scoped>
    .title {
        @apply absolute -top-9 -left-7 rounded-full p-1.5 uppercase bg-sky-500 text-sky-100 font-bold text-xs shadow
    }
</style>
