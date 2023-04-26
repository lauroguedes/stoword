<template>
    <div>
        <form
            @submit.prevent="onSubmit"
            class="p-3 bg-gray-200 dark:bg-gray-700 rounded-md"
        >
            <TextInput
                v-model="form.word"
                type="text"
                placeholder="Word or Expression ..."
                class="w-full"
            />
            <div class="mt-2 space-x-2 text-right">
                <PrimaryButton type="submit"> Generate </PrimaryButton>
            </div>
        </form>
        <Loading v-if="loading" />
        <div
            v-if="data"
            v-html="data.sentences"
            class="m-3 text-slate-400"
        ></div>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useFetch } from "@/Composables/useFetch";
import Loading from "@/Components/App/Loading.vue";

const form = useForm({
    word: "",
});

const { data, loading, error, getData } = useFetch();

const onSubmit = async () => {
    getData(route("generate.sentences", { word: form.word }));
};
</script>
