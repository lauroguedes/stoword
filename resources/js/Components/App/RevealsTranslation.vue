<template>
    <div class="relative">
        <span :class="design" v-if="revealText" v-html="text"></span>
        <button
            title="Reveals Translation"
            @click="revealText = !revealText"
            class="p-1 disabled:bg-transparent bg-gray-300 hover:bg-gray-300/80 active:bg-gray-300/50 dark:bg-gray-700 dark:active:bg-gray-700/50 dark:hover:bg-gray-700/80 shadow-sm rounded-md"
        >
            <Language />
        </button>
    </div>
</template>

<script setup>
    import {ref} from "vue";
    import Language from "@/Components/Icons/Language.vue";

    const props = defineProps({
        text: {
            type: String,
            required: true,
        },
        design: {
            type: String,
            default: "text-gray-400 mr-2"
        },
    });

    const revealText = ref(false);
</script>
