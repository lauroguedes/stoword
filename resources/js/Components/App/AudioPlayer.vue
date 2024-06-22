<script setup>
import {ref} from "vue";

const audioElement = ref(null);
const audioSrc = ref(null);

const props = defineProps({
    src: {
        type: String,
        required: true
    }
});

const play = async () => {
    await fetch(route('tts.audio', {src: props.src}))
        .then(response => response.json())
        .then(data => {
            audioSrc.value = data;
            if (audioElement.value) {
                audioElement.value.load();
                audioElement.value.play();
            }
        })
        .catch(error => console.log(error));
}
</script>

<template>
    <div>
        <audio ref="audioElement">
            <source :src="audioSrc">
            Your browser does not support the audio element.
        </audio>
        <button class="p-2 border border-amber-50 text-gray-200 rounded" @click="play">Teste</button>
    </div>
</template>

<style scoped>

</style>
