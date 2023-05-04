<template>
    <div
        class="mt-5 p-3 bg-gray-200 dark:bg-gray-700 rounded-md text-slate-700 dark:text-slate-300"
    >
        <ul
            class="text-2xl divide-y divide-slate-700 dark:divide-slate-600 divide-dashed"
        >
            <li
                v-for="sentence in sentences"
                class="p-3 dark:bg-gray-700 dark:hover:bg-gray-800/20 flex justify-between items-center"
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
