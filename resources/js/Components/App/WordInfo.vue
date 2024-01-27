<template>
    <div class="my-5 text-white">
        <ShowWord :ipa="data.ipa_word" :translation="data.translate" :word="data.word" />
        <div
            class="flex flex-col justify-center text-center text-lg text-gray-400 space-x-1"
        >
            <div v-if="data.plural">
                <span class="uppercase text-sm">Plural: </span
                ><span class="font-semibold">{{ data.plural }}</span>
            </div>
            <div v-if="data.synonyms">
                <span class="uppercase text-sm">Synonyms: </span
                ><span class="font-semibold">{{ data.synonyms }}</span>
            </div>
            <div v-if="data.word_forms">
                <span class="uppercase text-sm">Other forms: </span
                ><span class="font-semibold">{{ data.word_forms }}</span>
            </div>
        </div>
    </div>
</template>

<script setup>
import {computed, ref} from "vue";
import { useStore } from "vuex";
import ShowWord from "@/Components/App/ShowWord.vue";

const store = useStore();

const data = computed(() => store.state.wordResponse);

const revealTranslate = ref(false)
</script>
