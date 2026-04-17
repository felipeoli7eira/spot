<script setup>
import PageHeaderComponent from '@/components/pageHeader/index.vue'

import { defineProps, onMounted } from 'vue';

import useCadastro from './hooks/useCadastro.ts'
import useListagemCategorias from './../../categories/hooks/useRead.ts'

const props = defineProps({
    onCreated: {
        type: Function,
        required: true
    }
})

const { cadastrando, cadastrar, resposta, dadosParaCadastro, dialog, abrirDialogo, fecharDialogo } = useCadastro()
const { handle: buscarCategorias, data: categorias, requestIsRunning: listandoCategorias } = useListagemCategorias()

onMounted(async () => {
    await buscarCategorias()
})

</script>

<template>
    <div class="text-end">
        <button type="button" class="btn btn-primary" @click="abrirDialogo">Cadastrar</button>

        <dialog id="dialog" class="modal" ref="dialog">
            <div class="modal-box text-start">
                <h1 class="text-2xl font-bold">Cadastro</h1>
                <p class="py-1 text-sm">Pressione ESC ou clique fora para fechar.</p>

                <div class="flex flex-col space-y-2">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" placeholder="Digite aqui..." class="input w-full"
                        v-model="dadosParaCadastro.nome">
                </div>

                <div class="flex flex-col space-y-2 mt-4">
                    <label for="nome">Descrição</label>
                    <input type="text" name="nome" placeholder="Digite aqui..." class="input w-full"
                        v-model="dadosParaCadastro.descricao">
                </div>

                <div class="flex flex-col space-y-2 mt-4">
                    <label for="nome">Categoria</label>

                    <select class="select w-full" name="categoria" v-model="dadosParaCadastro.categoria">
                        <option disabled selected>Clique e selecione</option>

                        <option v-for="c in categorias" :value="c.uuid">{{ c.nome }}</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-1.5">
                    <button type="button" class="btn btn-ghost mt-4" :disabled="cadastrando">Cencelar</button>
                    <button type="button" class="btn btn-primary mt-4" :disabled="cadastrando" @click="async () => {
                        await cadastrar()
                        fecharDialogo()
                        props.onCreated()
                    }">Cadastrar</button>
                </div>
            </div>
        </dialog>
    </div>
</template>

<style lang="scss" scoped></style>
