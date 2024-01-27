<template>
    <div class="p-5 bg-gray-200 dark:bg-gray-800 rounded-md shadow">
        <div
            class="relative text-gray-600 dark:text-gray-400 text-lg mb-2"
        >
            <div class="absolute -top-9 -right-9">
                <span
                    class="inline-flex items-center gap-x-2 rounded-full bg-green-600/20 px-2.5 py-1 text-sm font-semibold leading-5 text-green-600"
                >
                    <span
                        class="inline-block h-1.5 w-1.5 rounded-full bg-green-600"
                    ></span>
                    {{ data.part_of_speech }}
                </span>
            </div>
            <div class="text-xl">
                <div>
                    <span>{{ data.meaning.value }}</span>
                    <div class="flex space-x-2">
                        <ClipBoard :text="data.meaning.value" />
                        <RevealsTranslation design="opacity-70 mt-2" :text="data.meaning.translate" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {computed, ref} from "vue";
import { useStore } from "vuex";
import RevealsTranslation from "@/Components/App/RevealsTranslation.vue";
import ClipBoard from "@/Components/App/ClipBoard.vue";

const store = useStore();

const data = computed(() => store.state.wordResponse);

const revealTranslate = ref(false)
</script>
