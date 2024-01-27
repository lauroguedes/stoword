<template>
    <div class="popover-container">
        <button @click="togglePopover" class="btn">Toggle Popover</button>
        <div v-if="isPopoverVisible" class="popover">
            <!-- Popover content goes here -->
            This is the popover content.
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const isPopoverVisible = ref(false);

const togglePopover = () => {
    isPopoverVisible.value = !isPopoverVisible.value;
};
</script>

<style scoped>
.popover-container {
    @apply relative;
}

.popover {
    @apply absolute top-full left-0 bg-white border p-4 shadow-md z-10;
}
</style>

