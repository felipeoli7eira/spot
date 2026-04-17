<script setup>
import { defineProps } from 'vue'

defineProps({
    message: {
        type: String,
        default: 'Carregando...'
    }
})
</script>

<template>
    <div class="fixed inset-0 flex items-center justify-center z-50 bg-accent/90 glass-blur">
        <div class="flex items-center gap-5">
            <span class="loading loading-spinner loading-md"></span>
            <p>{{ message }}</p>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>
