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
                    <Badge text="New" />
                </div>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import Badge from "@/Components/App/Badge.vue";

const wordsHistory = ref([]);

const fetchHistory = async () => {
    try {
        const response = await axios("api/words/history");
        wordsHistory.value = await response.data;
    } catch (error) {
        console.log(error);
    }
};

onMounted(fetchHistory);
</script>
