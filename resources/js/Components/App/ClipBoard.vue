<template>
    <button
        title="Copy"
        :disabled="wasCopied"
        @click="copyElement"
        class="btn"
    >
        <Copy v-if="!wasCopied" />
        <Check v-else />
    </button>
</template>

<script setup>
import { toClipboard } from "@soerenmartius/vue3-clipboard";
import Copy from "../Icons/Copy.vue";
import Check from "../Icons/Check.vue";
import { ref } from "vue";

const props = defineProps({
    text: {
        type: String,
        required: true,
    },
});

const wasCopied = ref(false);

const copyElement = () => {
    const clearText = props.text.replace(/<[^>]+>/gi, "");
    toClipboard(clearText);

    wasCopied.value = true;

    setTimeout(() => {
        wasCopied.value = false;
    }, 2000);
};
</script>

<style scoped>
.btn {
    @apply p-1 disabled:bg-transparent bg-gray-300 hover:bg-gray-300/80 active:bg-gray-300/50 dark:bg-gray-700 dark:active:bg-gray-700/50 dark:hover:bg-gray-700/80 shadow-sm rounded-md
}
</style>
