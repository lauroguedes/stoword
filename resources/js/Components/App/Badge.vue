<template>
<span
    :class="`bg-${color}-600/20 text-${color}-600`"
    class="inline-flex items-center gap-x-2 rounded-full px-2.5 py-1 text-sm font-semi-bold leading-5"
>
    <span
        class="inline-block h-1.5 w-1.5 rounded-full bg-green-600"
    ></span>
    {{ text }}
</span>
</template>

<script setup>
const props = defineProps({
    text: {
        type: String,
        required: true,
    },
    color: {
        type: String,
        default: 'green'
    }
})
</script>
