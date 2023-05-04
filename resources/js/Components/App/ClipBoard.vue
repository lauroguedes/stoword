<template>
    <button
        title="Copy"
        :disabled="wasCopied"
        @click="copyElement"
        class="p-1 disabled:bg-transparent bg-slate-400 dark:bg-slate-600 shadow-sm rounded-md active:bg-slate-600/50 hover:bg-slate-600/80"
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
