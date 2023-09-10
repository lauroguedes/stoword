<template>
    <div class="max-w-2xl mx-auto">
        <form
            @submit.prevent="onSubmit"
            class="p-5 bg-gray-200 dark:bg-gray-800 rounded-md shadow"
        >
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h1
                        class="text-gray-600 dark:text-gray-400 font-bold text-lg mb-2"
                    >
                        Qtd. Sentences
                    </h1>
                    <div class="flex justify-between items-center gap-3">
                        <div class="flex items-center gap-1">
                            <input
                                id="one"
                                type="radio"
                                v-model="form.qtd_sentences"
                                value="1"
                                class="accent-indigo-400 dark:accent-indigo-600"
                            />
                            <InputLabel for="one">One</InputLabel>
                        </div>
                        <div class="flex items-center gap-1">
                            <input
                                id="two"
                                type="radio"
                                v-model="form.qtd_sentences"
                                value="2"
                                class="accent-indigo-400 dark:accent-indigo-600"
                            />
                            <InputLabel for="two">Two</InputLabel>
                        </div>
                        <div class="flex items-center gap-1">
                            <input
                                id="three"
                                type="radio"
                                v-model="form.qtd_sentences"
                                value="3"
                                class="accent-indigo-400 dark:accent-indigo-600"
                            />
                            <InputLabel for="three">Three</InputLabel>
                        </div>
                    </div>
                </div>
                <div>
                    <h1
                        class="text-gray-800 dark:text-gray-400 font-bold text-lg mb-2"
                    >
                        Level
                    </h1>
                    <div class="flex justify-between items-center gap-3">
                        <div
                            v-for="level in levelOptions"
                            class="flex items-center gap-1"
                        >
                            <input
                                :id="level"
                                type="radio"
                                v-model="form.level"
                                :value="level"
                                class="accent-indigo-400 dark:accent-indigo-600"
                            />
                            <InputLabel :for="level">{{ level }}</InputLabel>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <TextInput
                    v-model="form.word"
                    type="text"
                    placeholder="Word or Phrasal verb ..."
                    class="w-full h-16 text-2xl rounded-lg mr-3"
                    :disabled="loading"
                />
                <PrimaryButton
                    :disabled="loading || !form.word || form.word.length > 20"
                    type="submit"
                    class="h-16 text-md rounded-lg"
                >
                    Generate
                </PrimaryButton>
            </div>
            <ExtraLinks
                v-if="wordResponse.word"
                :word-sent="wordResponse.word"
            />
        </form>
        <Loading v-if="loading" />
        <InputError class="p-2 mt-2" :message="error" />
        <WordInfo v-if="wordResponse.word" />
        <WordMean v-if="wordResponse.meaning?.value" />
        <Sentences v-if="wordResponse.sentences?.length" />
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useFetch } from "@/Composables/useFetch";
import Loading from "./Loading.vue";
import Sentences from "./Sentences.vue";
import InputLabel from "../InputLabel.vue";
import InputError from "../InputError.vue";
import { computed } from "vue";
import { useStore } from "vuex";
import ExtraLinks from "./ExtraLinks.vue";
import WordInfo from "./WordInfo.vue";
import WordMean from "./WordMean.vue";

const store = useStore();

const form = useForm({
    qtd_sentences: 1,
    level: "A1",
    word: "",
});

const levelOptions = ["A1", "A2", "B1", "B2", "C1", "C2"];

const { loading, error, getData } = useFetch();

const wordResponse = computed(() => store.state.wordResponse);

const onSubmit = async () => {
    await getData(
        route("generate.sentences", {
            word: form.word,
            qtd_sentences: form.qtd_sentences,
            level: form.level,
        })
    );

    if (!error.value) {
        form.reset();
    }
};
</script>
