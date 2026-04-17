<script setup>

import PageHeaderComponent from '@/components/pageHeader/index.vue'
import Cadastro from "./components/cadastro.vue"
import { Edit, Trash } from 'lucide-vue-next';
import { onMounted } from 'vue';

import useListagem from './hooks/useListagem.ts'
import useAtualizacao from './hooks/useAtualizacao.ts'
import useDelecao from './hooks/useDelecao.ts'

const { listar, listando, lista: produtos } = useListagem()
const { atualizando, atualizar, produtoParaAtualizacao, dialogo: dialogoAtualizacao, categorias, confirmarAtualizacao } = useAtualizacao()
const { dialogoDelecao, produtoParaDeletar, deletar, cancelarDelecao, confirmarDelecao } = useDelecao()

onMounted(async () => {
    await listar()
})
</script>

<template>
    <div>
        <PageHeaderComponent :title="'Produtos'" :description="'Gestão completa de produtos.'" />

        <div class="my-5">
            <Cadastro :onCreated="async () => {
                await listar()
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
                            <button type="button" class="btn btn-xs btn-error" @click="() => deletar(p)">
                                <Trash :size="20" class="" />
                            </button>
                            <button type="button" class="btn btn-xs btn-primary" @click="() => atualizar(p)">
                                <Edit :size="20" class="" />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- atualizacap -->
        <dialog id="dialogoAtualizacao" class="modal" ref="dialogoAtualizacao">
            <div class="modal-box text-start">
                <h1 class="text-2xl font-bold">Atualização</h1>
                <p class="py-1 text-sm">Pressione ESC ou clique fora para fechar.</p>

                <div class="flex flex-col space-y-2">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" placeholder="Digite aqui..." class="input w-full"
                        v-model="produtoParaAtualizacao.nome">
                </div>

                <div class="flex flex-col space-y-2 mt-4">
                    <label for="nome">Descrição</label>
                    <input type="text" name="nome" placeholder="Digite aqui..." class="input w-full"
                        v-model="produtoParaAtualizacao.descricao">
                </div>

                <div div class=" flex flex-col space-y-2 mt-4">
                    <label for="nome">Categoria</label>

                    <select class="select w-full" name="categoria" v-model="produtoParaAtualizacao.categoria.uuid">
                        <option disabled selected>Clique e selecione</option>

                        <option v-for="c in categorias" :value="c.uuid"
                            :selected="c.uuid === produtoParaAtualizacao.categoria.uuid">{{ c.nome }}</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-1.5">
                    <button type="button" class="btn btn-ghost mt-4" :disabled="atualizando">Cencelar</button>
                    <button type="button" class="btn btn-primary mt-4" :disabled="atualizando" @click="async () => {
                        await confirmarAtualizacao()
                        await listar(0)
                    }">Atualizar</button>
                </div>
            </div>
        </dialog>

        <!-- atualizacap -->
        <dialog id="dialogoDelecao" class="modal" ref="dialogoDelecao">
            <div class="modal-box text-start">
                <h1 class="text-2xl font-bold">Deletar "{{ produtoParaDeletar.nome }}"?</h1>
                <p class="py-1 text-sm">Pressione ESC ou clique fora para fechar.</p>

                <div class="flex justify-end space-x-1.5">
                    <button type="button" class="btn btn-ghost mt-4" @click="cancelarDelecao">Cencelar</button>
                    <button type="button" class="btn btn-error mt-4" @click="async () => {
                        await confirmarDelecao()
                        await listar()
                    }">Confirmar</button>
                </div>
            </div>
        </dialog>
    </div>
</template>

<style lang="scss" scoped></style>
