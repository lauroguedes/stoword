<template>
    <div class="my-5 text-white">
        <div class="flex mb-2 justify-center gap-3 items-center text-3xl">
            <div class="text-gray-300">{{ data.word }}</div>
            <div class="mx-1">|</div>
            <div class="text-gray-400">{{ data.ipa_word }}</div>
        </div>
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
import { computed } from "vue";
import { useStore } from "vuex";

const store = useStore();

const data = computed(() => store.state.wordResponse);
</script>
