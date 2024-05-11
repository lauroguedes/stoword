<template>
    <div class="p-5 bg-gray-200 dark:bg-gray-800 rounded-md shadow">
        <div
            class="relative text-gray-600 dark:text-gray-400 mb-2"
        >
            <div v-if="word.part_of_speech" class="absolute -top-9 -right-9">
                <Badge :text="word.part_of_speech" />
            </div>
            <div class="text-xl relative">
                <BoxTitle class="absolute -top-9 -left-7 bg-sky-500 text-sky-100" text="meaning" />
                <div class="flex justify-between items-center">
                    <div>{{ word.meaning.value }}</div>
                    <ActionsBtn :translation="word.meaning.translate" :text="word.meaning.value" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {computed, ref} from "vue";
import { useStore } from "vuex";
import ActionsBtn from "@/Components/App/ActionsBtn.vue";
import BoxTitle from "@/Components/App/BoxTitle.vue";
import Badge from "@/Components/App/Badge.vue";

const store = useStore();

const word = computed(() => store.state.wordResponse);

const revealTranslate = ref(false)
</script>
