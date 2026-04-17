<script setup lang="ts">
import { onMounted } from 'vue'
import PageHeaderComponent from '@/components/pageHeader/index.vue'

onMounted(() => {
    document.title = 'Spot - Tech Challenge'
})
</script>

<template>
    <div class="">
        <PageHeaderComponent :title="'Dashboard'"
            :description="'Acompanhe dados e metricas de categorias e produtos.'" />

        <div class="mt-5">
            ...
        </div>
    </div>
</template>
