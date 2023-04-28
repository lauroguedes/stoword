<template>
    <div
        class="mt-5 p-5 bg-gray-200 dark:bg-gray-700 rounded-md text-gray-700 dark:text-white"
    >
        <ul>
            <li v-for="sentence in sentences">
                <span v-html="sentence"></span>
            </li>
        </ul>
    </div>
</template>

<script setup>
const props = defineProps({
    sentences: {
        type: Array,
        required: true,
    },
});
</script>
