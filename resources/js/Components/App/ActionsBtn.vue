<template>
    <div class="flex items-center space-x-2">
        <ClipBoard :text="text" />
        <RevealsTranslation :text="translation" />
    </div>
</template>

<script setup>
import ClipBoard from "@/Components/App/ClipBoard.vue";
import RevealsTranslation from "@/Components/App/RevealsTranslation.vue";

const props = defineProps({
    text: {
        type: String,
        required: true,
    },
    translation: {
        type: String,
        required: true
    }
})
</script>
