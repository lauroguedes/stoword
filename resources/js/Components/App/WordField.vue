<template>
    <div class="max-w-2xl mx-auto">
        <form
            @submit.prevent="onSubmit"
            class="p-5 bg-gray-200 dark:bg-gray-700 rounded-md"
        >
            <div class="flex justify-between items-center mb-3">
                <div>
                    <h1 class="text-gray-600 dark:text-gray-300 text-lg mb-2">
                        Qtd. Sentences
                    </h1>
                    <div class="flex justify-between items-center gap-3">
                        <div class="flex items-center gap-1">
                            <input
                                type="radio"
                                v-model="form.qtd_sentences"
                                value="1"
                            />
                            <InputLabel>One</InputLabel>
                        </div>
                        <div class="flex items-center gap-1">
                            <input
                                type="radio"
                                v-model="form.qtd_sentences"
                                value="2"
                            />
                            <InputLabel>Two</InputLabel>
                        </div>
                        <div class="flex items-center gap-1">
                            <input
                                type="radio"
                                v-model="form.qtd_sentences"
                                value="3"
                            />
                            <InputLabel>Three</InputLabel>
                        </div>
                    </div>
                </div>
                <div>
                    <h1 class="text-gray-600 dark:text-gray-300 text-lg mb-2">
                        Level
                    </h1>
                    <div class="flex justify-between items-center gap-3">
                        <div
                            v-for="level in levelOptions"
                            class="flex items-center gap-1"
                        >
                            <input
                                type="radio"
                                v-model="form.level"
                                :value="level"
                            />
                            <InputLabel>{{ level }}</InputLabel>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <TextInput
                    v-model="form.word"
                    type="text"
                    placeholder="Word or Expression ..."
                    class="w-full h-16 text-2xl rounded-lg mr-3"
                />
                <PrimaryButton type="submit" class="h-16 text-md rounded-lg">
                    Generate
                </PrimaryButton>
            </div>
        </form>
        <Loading v-if="loading" />
        <InputError class="p-2 mt-2" :message="error" />
        <Sentences v-if="data.length" :sentences="data" />
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

const form = useForm({
    qtd_sentences: 1,
    level: "A1",
    word: "",
});

const levelOptions = ["A1", "A2", "B1", "B2", "C1", "C2"];

const { data, loading, error, getData } = useFetch();

const onSubmit = async () => {
    getData(
        route("generate.sentences", {
            word: form.word,
            level: form.level,
            qtd_sentences: form.qtd_sentences,
        })
    );
};
</script>
