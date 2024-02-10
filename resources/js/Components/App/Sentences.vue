<template>
    <div
        class="mt-5 p-3 shadow bg-gray-200 dark:bg-gray-800 rounded-md text-gray-600 dark:text-gray-400"
    >
        <BoxTitle text="sentences" />
        <ul
            class="text-xl divide-y divide-gray-300 dark:divide-gray-700 divide-dashed"
        >
            <li
                v-for="sentence in sentences"
                class="p-3 hover:bg-gray-300/30 dark:bg-gray-800 dark:hover:bg-gray-900/20 flex justify-between items-center"
            >
                <div v-html="sentence?.value"></div>
                <ActionsBtn :translation="sentence?.translate" :text="sentence?.value" />
            </li>
        </ul>
    </div>
</template>

<script setup>
import { computed } from "vue";
import ActionsBtn from "@/Components/App/ActionsBtn.vue";
import { useStore } from "vuex";
import BoxTitle from "@/Components/App/BoxTitle.vue";

const store = useStore();

const sentences = computed(() => store.state.wordResponse.sentences);
</script>
