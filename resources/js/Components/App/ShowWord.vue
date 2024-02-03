<template>
    <div class="flex mb-2 justify-center gap-3 items-center text-3xl">
        <div class="text-gray-300 underline underline-offset-8 decoration-sky-500 decoration-wavy decoration-2" title="Translation">{{ word }}</div>
        <ClipBoard :text="word" />
        <RevealsTranslation :text="translation" />
        <div class="mx-1">|</div>
        <div class="text-gray-400 italic">{{ ipa }}</div>
    </div>
</template>

<script setup>
    import RevealsTranslation from "@/Components/App/RevealsTranslation.vue";
    import ClipBoard from "@/Components/App/ClipBoard.vue";

    const props = defineProps({
        word: {
            type: String,
            required: true,
        },
        translation: {
            type: String,
            required: true,
        },
        ipa: {
            type: String,
            required: true,
        },
    });
</script>
