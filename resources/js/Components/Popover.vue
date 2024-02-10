<template>
    <div class="popover-container">
        <Popper arrow placement="top" class="p-0">
            <button class="btn">
                <slot></slot>
            </button>
            <template #content>
                <div class="popover-content">{{ content }}</div>
            </template>
        </Popper>
    </div>
</template>

<script setup>
import Popper from "vue3-popper";

const props = defineProps({
    content: {
        type: String,
        default: 'content...',
    },
});
</script>

<style scoped>
.btn {
    @apply p-1 disabled:bg-transparent bg-gray-300 hover:bg-gray-300/80 active:bg-gray-300/50 dark:bg-gray-700 dark:active:bg-gray-700/50 dark:hover:bg-gray-700/80 shadow-sm rounded-md
}

.popover-container {
    @apply relative;
}

.popover-content {
    @apply bg-gray-500 w-max text-gray-200 text-base p-2 border border-gray-400 rounded;
}
</style>
