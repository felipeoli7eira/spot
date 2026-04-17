<script setup>

import PageHeaderComponent from '@/components/pageHeader/index.vue'
import Cadastro from "./components/cadastro.vue"
import { Edit, Trash } from 'lucide-vue-next';
import { onMounted } from 'vue';

import useListagem from './hooks/useListagem.ts'

const { listar, listando, lista: produtos } = useListagem()

onMounted(async () => {
    await listar()
})

</script>

<template>
    <div>
        <PageHeaderComponent :title="'Produtos'" :description="'Gestão completa de produtos.'" />

        <div class="my-5">
            <Cadastro :onCreated="() => {
                console.log('created')
            }" />
        </div>

        <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Categoria</th>
                        <th>Criado em</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(p, index) in produtos" :key="p.uuid">
                        <th>{{ index + 1 }}</th>
                        <td>{{ p.nome }}</td>
                        <td>{{ p.descricao }}</td>
                        <td>{{ p?.categoria?.nome }}</td>
                        <td>{{ p.dt_criacao }}</td>
                        <td class="space-x-1">
                            <button type="button" class="btn btn-xs btn-error">
                                <Trash :size="20" class="" />
                            </button>
                            <button type="button" class="btn btn-xs btn-primary">
                                <Edit :size="20" class="" />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>
