<script setup>
import { onMounted } from 'vue';
import { Trash, Edit } from 'lucide-vue-next'

import PageHeaderComponent from '@/components/pageHeader/index.vue'

import useReadCategories from './hooks/useRead';
import useUpdateCategories from './hooks/useUpdate';
import useDeleteCategories from './hooks/useDelete';
import useCreateCategories from './hooks/useCreate';

const { handle, data, requestIsRunning } = useReadCategories()
const { toUpdate, modalUpdateRef, objectUpdate, cancelUpdate, confirmUpdate, requestIsRunning: requestUpdateIsRunning } = useUpdateCategories()
const { objectToDelete, confirmDelete, modalDeleteRef, requestIsRunning: requestDeleteIsRunning, closeDeleteDialog, toDelete } = useDeleteCategories()
const { form, dialog: createDialog, requestIsRunning: reqCreateIsRunning, closeDialog, openCreateForm, create } = useCreateCategories()

onMounted(async () => {
    await handle()
})
</script>

<template>
    <main>
        <PageHeaderComponent :title="'Categorias'" :description="'Gerencie categorias de produtos.'" />

        <div class="mt-10">
            <div class="mb-5 text-end">
                <button class="btn btn-primary" type="button" @click="openCreateForm">Cadastro</button>
            </div>

            <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Status</th>
                            <th>Criada em</th>
                            <th>Atualizada em</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(categoria, index) in data">
                            <th>{{ index + 1 }}</th>
                            <td>{{ categoria.nome }}</td>
                            <td>{{ categoria.descricao }}</td>

                            <td :class="{
                                'text-red-600': categoria.status === 0,
                                'text-green-500': categoria.status === 1,
                            }">{{ categoria.status === 1 ? 'Ativo' : 'Inativo' }}</td>

                            <td>{{ categoria.dt_criacao }}</td>
                            <!-- <td>{{ categoria.dt_atualizacao }}</td> -->
                            <td class="space-x-2">
                                <button type="button" class="btn btn-xs btn-error" @click="() => toDelete(categoria)">
                                    <Trash :size="20" class="" />
                                </button>
                                <button type="button" class="btn btn-xs btn-primary" @click="() => toUpdate(categoria)">
                                    <Edit :size="20" class="" />
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- delete -->
        <dialog id="deleteDialog" class="modal" ref="modalDeleteRef">
            <div class="modal-box">
                <h1 class="text-2xl font-bold">Deletar categoria {{ objectToDelete.nome }}?</h1>
                <p class="py-1 text-sm">Pressione ESC ou clique fora para fechar.</p>


                <div class="flex space-x-1.5">
                    <button type="button" class="btn btn-ghost mt-4" :disabled="requestDeleteIsRunning"
                        @click="closeDeleteDialog">Cencelar</button>
                    <button type="button" class="btn btn-primary mt-4" :disabled="requestDeleteIsRunning" @click="() => confirmDelete(async () => {
                        await handle()

                        closeDeleteDialog()
                    })">Deletar</button>
                </div>
            </div>
        </dialog>

        <!-- update -->
        <dialog id="updateDialog" class="modal" ref="modalUpdateRef">
            <div class="modal-box">
                <h1 class="text-2xl font-bold">{{ objectUpdate.nome }}</h1>
                <p class="py-1 text-sm">Pressione ESC ou clique fora para fechar.</p>

                <div class="mt-5">
                    <div class="">
                        <label for="nome" class="mb-1 block">Nome</label>
                        <input type="text" class="input" placeholder="Digite aqui..." id="nome"
                            v-model="objectUpdate.nome">
                    </div>
                </div>


                <div class="mt-5">
                    <div class="">
                        <label for="descricao" class="mb-1 block">Descrição</label>
                        <input type="text" class="input" placeholder="Digite aqui..." id="descricao"
                            v-model="objectUpdate.descricao">
                    </div>
                </div>


                <div class="mt-5">
                    <div class="">
                        <label for="nome" class="mb-1 block">Status</label>
                        <select class="select" v-model="objectUpdate.status">
                            <option value="0">Inativo</option>
                            <option value="1">Ativo</option>
                        </select>
                    </div>
                </div>


                <div class="flex space-x-1.5">
                    <button type="button" class="btn btn-ghost mt-4" :disabled="requestUpdateIsRunning"
                        @click="cancelUpdate">Cencelar</button>
                    <button type="button" class="btn btn-primary mt-4" :disabled="requestUpdateIsRunning" @click="() => confirmUpdate(async () => {
                        await handle()

                        cancelUpdate()
                    })">Atualizar</button>
                </div>
            </div>
        </dialog>

        <!-- create -->
        <dialog id="createDialog" class="modal" ref="createDialog">
            <div class="modal-box">
                <h1 class="text-2xl font-bold">Cadastro</h1>
                <p class="py-1 text-sm">Pressione ESC ou clique fora para fechar.</p>

                <div class="mt-5">
                    <div class="">
                        <label for="nome" class="mb-1 block">Nome</label>
                        <input type="text" class="input" placeholder="Digite aqui..." id="nome" v-model="form.nome">
                    </div>
                </div>


                <div class="mt-5">
                    <div class="">
                        <label for="descricao" class="mb-1 block">Descrição</label>
                        <input type="text" class="input" placeholder="Digite aqui..." id="descricao"
                            v-model="form.descricao">
                    </div>
                </div>


                <div class="mt-5">
                    <div class="">
                        <label for="nome" class="mb-1 block">Status</label>
                        <select class="select" v-model="form.status">
                            <option value="0">Inativo</option>
                            <option value="1">Ativo</option>
                        </select>
                    </div>
                </div>


                <div class="flex space-x-1.5">
                    <button type="button" class="btn btn-ghost mt-4" :disabled="reqCreateIsRunning"
                        @click="cancelUpdate">Cencelar</button>
                    <button type="button" class="btn btn-primary mt-4" :disabled="reqCreateIsRunning" @click="() => create(async () => {
                        await handle()
                        closeDialog()
                    })">Cadastrar</button>
                </div>
            </div>
        </dialog>
    </main>
</template>

<style lang="scss" scoped></style>
