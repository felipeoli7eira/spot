<script setup lang="ts">
const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    description: {
        type: String,
        required: true,
    },
})
</script>

<template>
    <header class="page-header">
        <h1 class="text-3xl font-black">{{ title }}</h1>
        <p class="mt-1 text-sm md:text-base">{{ description }}</p>
    </header>
</template>
