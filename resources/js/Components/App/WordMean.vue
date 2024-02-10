<template>
    <div class="p-5 bg-gray-200 dark:bg-gray-800 rounded-md shadow">
        <div
            class="relative text-gray-600 dark:text-gray-400 mb-2"
        >
            <div class="absolute -top-9 -right-9">
                <span
                    class="inline-flex items-center gap-x-2 rounded-full bg-green-600/20 px-2.5 py-1 text-sm font-semi-bold leading-5 text-green-600"
                >
                    <span
                        class="inline-block h-1.5 w-1.5 rounded-full bg-green-600"
                    ></span>
                    {{ data.part_of_speech }}
                </span>
            </div>
            <div class="text-xl relative">
                <BoxTitle text="meaning" />
                <div class="flex justify-between items-center">
                    <div>{{ data.meaning.value }}</div>
                    <ActionsBtn :translation="data.meaning.translate" :text="data.meaning.value" />
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

const store = useStore();

const data = computed(() => store.state.wordResponse);

const revealTranslate = ref(false)
</script>
