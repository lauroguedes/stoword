<template>
    <div
        class="flex justify-between items-center mt-4 pt-2 text-right border-t border-gray-300 dark:border-gray-700"
    >
        <div>
            <a
                @click="dehydrateWordResponse"
                title="My Vocabulary"
                class="cursor-pointer text-gray-500 dark:text-gray-400 hover:opacity-80 hover:underline"
            ><GlobeAlt class="mr-2 inline" /></a>
        </div>
        <div class="space-x-5">
            <a
                :href="`https://giphy.com/search/${wordSent}`"
                target="_blank"
                class="text-gray-500 dark:text-gray-400 hover:opacity-80 hover:underline"
            ><Gif class="mr-2 inline" />Image</a
            >
            <a
                :href="`https://dictionary.cambridge.org/us/dictionary/english/${wordSent}`"
                target="_blank"
                class="text-gray-500 dark:text-gray-400 hover:opacity-80 hover:underline"
            ><AcademicCap class="mr-2 inline" />Meaning</a
            >

            <a
                :href="`https://youglish.com/pronounce/${wordSent}/english`"
                target="_blank"
                class="text-gray-500 dark:text-gray-400 hover:opacity-80 hover:underline"
            ><SpeakerWave class="mr-2 inline" />Pronunciation</a
            >
            <a
                :href="`https://translate.google.com/?sl=en&tl=${nativeLang}&text=${wordSent}&op=translate`"
                target="_blank"
                class="text-gray-500 dark:text-gray-400 hover:opacity-80 hover:underline"
            ><Language class="mr-2 inline" />Translate</a
            >
        </div>
    </div>
</template>

<script setup>
import SpeakerWave from "../Icons/SpeakerWave.vue";
import Language from "../Icons/Language.vue";
import AcademicCap from "../Icons/AcademicCap.vue";
import Gif from "../Icons/Gif.vue";
import GlobeAlt from "@/Components/Icons/GlobeAlt.vue";
import {useStore} from "vuex";

const store = useStore();

const props = defineProps({
    wordSent: {
        type: String,
        required: true,
    },
    nativeLang: {
        type: String,
        required: true,
    },
});

const dehydrateWordResponse = () => {
    store.commit('setWordResponse', {});
}
</script>
