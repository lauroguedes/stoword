<template>
    <div
        class="mt-5 p-3 shadow bg-gray-200 dark:bg-gray-800 rounded-md text-gray-600 dark:text-gray-400"
    >
        <ul
            class="text-2xl divide-y divide-gray-300 dark:divide-gray-700 divide-dashed"
        >
            <li
                v-for="item in sentences"
                class="p-3 hover:bg-gray-300/30 dark:bg-gray-800 dark:hover:bg-gray-900/20 flex justify-between items-center"
            >
                <span v-html="item?.sentence"></span>
                <ClipBoard :text="item?.sentence" />
            </li>
        </ul>
    </div>
</template>

<script setup>
import { computed } from "vue";
import ClipBoard from "./ClipBoard.vue";

const props = defineProps({
    sentences: {
        type: Array,
        required: true,
    },
    word: {
        type: String,
        required: true,
    },
});

const sentencesWithHighlight = computed(() => {
    return props.sentences.map((item) => {
        return item.sentence.replaceAll(
            props.word,
            `<span class="highlight decoration-secondary">${props.word}</span>`
        );
    });
});
</script>
