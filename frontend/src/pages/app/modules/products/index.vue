<script setup>

import PageHeaderComponent from '@/components/pageHeader/index.vue'
import Cadastro from "./components/cadastro.vue"
import { Edit, Trash } from 'lucide-vue-next';

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
                    <tr>
                        <th>1</th>
                        <td>Cy Ganderton</td>
                        <td>Quality Control Specialist</td>
                        <td>Blue</td>
                        <td>Blue</td>
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
