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
        @apply rounded-full p-1.5 uppercase font-bold text-xs shadow
    }
</style>
