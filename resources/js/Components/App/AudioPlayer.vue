<script setup>
import {ref} from "vue";
import Play from "@/Components/Icons/Play.vue";
import LoadingButton from "@/Components/Icons/LoadingButton.vue";

const audioElement = ref(null);
const audioSrc = ref(null);
const isLoading = ref(false);

const props = defineProps({
    src: {
        type: String,
        required: true
    }
});

const play = async () => {
    isLoading.value = true;
    try {
        const response = await fetch(route('tts.audio', { src: props.src }));
        audioSrc.value = await response.json();
        if (audioElement.value) {
            audioElement.value.load();
            await audioElement.value.play();
        }
        console.log('error');
    } catch (error) {
        console.error('Error playing audio:', error);
    } finally {
        isLoading.value = false;
    }
}
</script>

<template>
    <div>
        <audio ref="audioElement">
            <source :src="audioSrc">
            Your browser does not support the audio element.
        </audio>
        <button class="btn" @click="play" :disabled="isLoading">
            <Play v-if="!isLoading" />
            <LoadingButton v-else />
        </button>
    </div>
</template>

<style scoped>
.btn {
    @apply p-1 disabled:cursor-no-drop bg-gray-300 hover:bg-gray-300/80 active:bg-gray-300/50 dark:bg-gray-700 dark:active:bg-gray-700/50 dark:hover:bg-gray-700/80 shadow-sm rounded-md
}
</style>
