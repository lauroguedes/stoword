<template>
    <div class="p-5 bg-gray-200 dark:bg-gray-800 rounded-md shadow">
        <div
            class="relative text-gray-600 dark:text-gray-400 font-bold text-lg mb-2"
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
            <h1 class="uppercase font-bold">Mean</h1>
            <div>
                {{ data.meaning.value }}
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
