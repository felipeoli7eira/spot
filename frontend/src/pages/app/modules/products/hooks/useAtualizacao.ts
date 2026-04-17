import http from "@/services/http"
import { toast } from "@steveyuowo/vue-hot-toast"
import { ref } from "vue"

import useListagemDeCategorias from "@/pages/app/modules/categories/hooks/useRead.ts"

export default function useAtualizacao() {
    const produtoParaAtualizacao = ref<{
        uuid: string,
        nome: string,
        descricao: string,
        preco: number,
        categoria: {
            nome: string,
            descricao: string,
            status: number,
            uuid: string
        },
        dt_criacao: string,
        dt_atualizacao: string
    }>({
        uuid: "",
        nome: "",
        descricao: "",
        preco: 0,
        categoria: {
            nome: "",
            descricao: "",
            status: 0,
            uuid: ""
        },
        dt_criacao: "",
        dt_atualizacao: ""
    })
    const atualizando = ref(false)
    const dialogo = ref<null | HTMLDialogElement>(null)

    const categorias = ref([])

    const { handle: buscarCategorias, data: categoriasData } = useListagemDeCategorias()

    function limparCampos() {
        produtoParaAtualizacao.value = {
            uuid: "",
            nome: "",
            descricao: "",
            preco: 0,
            categoria: {
                nome: "",
                descricao: "",
                status: 0
            },
            dt_criacao: "",
            dt_atualizacao: ""
        }
    }

    async function atualizar(produtoParaAtualizar) {
        if (dialogo.value) {
            dialogo.value.showModal()

            produtoParaAtualizacao.value = produtoParaAtualizar

            await buscarCategorias()

            categorias.value = categoriasData.value
        }
    }

    async function confirmarAtualizacao() {
        try {
            atualizando.value = true

            const { data, status } = await http.patch("/produtos/".concat(produtoParaAtualizacao.value.uuid), {
                nome: produtoParaAtualizacao.value.nome,
                descricao: produtoParaAtualizacao.value.descricao,
                categoria: produtoParaAtualizacao.value.categoria.uuid,
            })

            toast.success("Produto atualizado com sucesso")

            limparCampos()

            dialogo.value?.close()
        } catch (error) {
            toast.error("Erro ao atualizar o produto")
        } finally {
            atualizando.value = false
        }
    }

    return {
        produtoParaAtualizacao,
        atualizar,
        atualizando,
        limparCampos,
        dialogo,
        categorias,
        confirmarAtualizacao
    }
}
