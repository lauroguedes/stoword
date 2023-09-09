<template>
    <div
        class="mt-5 p-3 shadow bg-gray-200 dark:bg-gray-800 rounded-md text-gray-600 dark:text-gray-400"
    >
        <ul
            class="text-2xl divide-y divide-gray-300 dark:divide-gray-700 divide-dashed"
        >
            <li
                v-for="sentence in sentences"
                class="p-3 hover:bg-gray-300/30 dark:bg-gray-800 dark:hover:bg-gray-900/20 flex justify-between items-center"
            >
                <span v-html="sentence?.value"></span>
                <ClipBoard :text="sentence?.value" />
            </li>
        </ul>
    </div>
</template>

<script setup>
import { computed } from "vue";
import ClipBoard from "./ClipBoard.vue";
import { useStore } from "vuex";

const store = useStore();

const sentences = computed(() => store.state.wordResponse.sentences);
</script>
