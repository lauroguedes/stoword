<template>
    <div class="p-5 mt-5 text-gray-800 dark:text-gray-400 bg-gray-200 dark:bg-gray-800 rounded-md shadow">
        <h1 class="text-sm uppercase mb-2">My Vocabulary</h1>
        <ul class="divide-y divide-gray-400 dark:divide-gray-700">
            <li v-for="word in wordsHistory" :key="word.id" class="py-2 px-1.5 cursor-pointer lowercase hover:bg-gray-300 dark:hover:bg-gray-700/20">
                <div class="flex justify-between items-center">
                    <div class="truncate mr-2">
                        <span class="font-bold">{{ word.name }}</span>
                        <span class="text-xs text-gray-400 dark:text-gray-500"> - {{ word.meaning.value }}</span>
                    </div>
                    <Badge v-if="word.part_of_speech" :text="word.part_of_speech" />
                </div>
            </li>
        </ul>
    </div>
</template>

<script setup>
import {onMounted, computed} from "vue";
import Badge from "@/Components/App/Badge.vue";
import { useFetchGet } from "@/Composables/useFetchGet";
import {useStore} from "vuex";

const store = useStore();

const {loading, error, getData} = useFetchGet();

const wordsHistory = computed(() => store.state.wordsHistory);

onMounted(async () => {
    await getData(route('words.history'));

    if (error.value) {
        console.log(error.value);
    }
});
</script>
