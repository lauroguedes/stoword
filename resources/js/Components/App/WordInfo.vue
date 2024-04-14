<template>
    <div class="my-5 text-white">
        <ShowWord :ipa="word.ipa" :translation="word.translate" :word="word.name" />
        <div
            class="flex flex-col justify-center text-center text-lg text-gray-400 space-x-1"
        >
            <div v-if="word.plural">
                <span class="uppercase text-sm">Plural: </span
                ><span class="font-semibold">{{ word.plural }}</span>
            </div>
            <div v-if="word.synonyms">
                <span class="uppercase text-sm">Synonyms: </span
                ><span class="font-semibold">{{ word.synonyms }}</span>
            </div>
            <div v-if="word.forms">
                <span class="uppercase text-sm">Other forms: </span
                ><span class="font-semibold">{{ word.forms }}</span>
            </div>
        </div>
    </div>
</template>

<script setup>
import {computed, ref} from "vue";
import { useStore } from "vuex";
import ShowWord from "@/Components/App/ShowWord.vue";

const store = useStore();

const word = computed(() => store.state.wordResponse);

const revealTranslate = ref(false)
</script>
