<template>
    <div
        class="mt-5 p-3 bg-gray-200 dark:bg-gray-800 rounded-md text-gray-800 dark:text-gray-400"
    >
        <ul
            class="text-2xl divide-y divide-gray-800 dark:divide-gray-700 divide-dashed"
        >
            <li
                v-for="sentence in sentences"
                class="p-3 dark:bg-gray-800 dark:hover:bg-gray-900/20 flex justify-between items-center"
            >
                <span v-html="sentence"></span>
                <ClipBoard :text="sentence" />
            </li>
        </ul>
    </div>
</template>

<script setup>
import ClipBoard from "./ClipBoard.vue";

const props = defineProps({
    sentences: {
        type: Array,
        required: true,
    },
});
</script>
