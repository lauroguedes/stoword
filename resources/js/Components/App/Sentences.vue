<template>
    <div>
        <ul>
            <li v-for="sentence in sentences">
                {{ sentence }}
            </li>
        </ul>
    </div>
</template>

<script setup>
defineProps({
    sentences: {
        type: Array,
        required: true,
    },
});
</script>
