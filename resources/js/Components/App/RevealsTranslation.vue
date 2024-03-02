<template>
    <div class="relative">
        <Popover :content="text">
            <Language />
        </Popover>
    </div>
</template>

<script setup>
    import Language from "@/Components/Icons/Language.vue";
    import Popover from "@/Components/Popover.vue";

    const props = defineProps({
        text: {
            type: String,
            required: true,
        }
    });
</script>
