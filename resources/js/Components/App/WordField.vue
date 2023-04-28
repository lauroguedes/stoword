<template>
    <div class="max-w-2xl mx-auto">
        <form
            @submit.prevent="onSubmit"
            class="p-5 bg-gray-200 dark:bg-gray-700 rounded-md flex justify-between items-center"
        >
            <TextInput
                v-model="form.word"
                type="text"
                placeholder="Word or Expression ..."
                class="w-full h-16 text-2xl rounded-lg mr-3"
            />
            <PrimaryButton type="submit" class="h-16 text-md rounded-lg">
                Generate
            </PrimaryButton>
        </form>
        <Loading v-if="loading" />
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

const form = useForm({
    word: "",
});

const { data, loading, error, getData } = useFetch();

const onSubmit = async () => {
    getData(route("generate.sentences", { word: form.word }));
};
</script>
