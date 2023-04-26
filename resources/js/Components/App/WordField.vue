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
                <PrimaryButton
                    :disabled="!form.word || form.processing"
                    type="submit"
                >
                    Generate
                </PrimaryButton>
            </div>
        </form>
        <ul>
            <li v-for="sentence in sentences">
                {{ sentence }}
            </li>
        </ul>
    </div>
</template>

<script setup>
import { reactive, ref, toRef } from "vue";
import { useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useFetch } from "@/Composables/useFetch";

const form = useForm({
    word: "",
});

const sentences = reactive({ data: [] });

const onSubmit = () => {
    // form.post(
    //     route("generate.sentences"),
    //     { word: form.word },
    //     {
    //         onSuccess: () => {
    //             form.reset();
    //         },
    //     }
    // );
    // fetch(route("generate.sentences", { word: form.word })).then((data) => {
    //     //console.log(res);
    //     sentences.value = data;
    // });
    const { data, error } = useFetch(
        route("generate.sentences", { word: form.word })
    );

    sentences.data = data;
};
</script>
