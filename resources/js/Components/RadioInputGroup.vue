<script setup>
import { ref } from "vue";
import TextInput from "./TextInput.vue";
import InputLabel from "./InputLabel.vue";

defineProps({
    model: {
        type: Number,
        required: true,
    },
    options: {
        type: Array,
        required: true,
    },
    groupTitle: {
        type: String,
        required: true,
    },
});

defineEmits(["update:model"]);

// const input = ref(null);
</script>

<template>
    <!-- <input
        class=""
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    /> -->
    <div>
        <h1 class="text-gray-600 dark:text-gray-300 text-lg mb-2">
            {{ groupTitle }}
        </h1>
        <div class="flex justify-between items-center gap-3">
            <div v-for="option in options" class="flex items-center gap-2">
                <TextInput type="radio" v-model="option.value" />
                <InputLabel>{{ option.title }}</InputLabel>
            </div>
        </div>
    </div>
</template>
