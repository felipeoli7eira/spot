import http from '@/services/http.ts'
import { toast } from '@steveyuowo/vue-hot-toast'
import { ref } from 'vue'

export default function useDelecao() {
    const dialogoDelecao = ref<null | HTMLDialogElement>(null)
    const produtoParaDeletar = ref({})

    function deletar(produto) {
        produtoParaDeletar.value = produto

        dialogoDelecao.value?.showModal()
    }

    function cancelarDelecao() {
        dialogoDelecao.value?.close()

        produtoParaDeletar.value = {}
    }

    async function confirmarDelecao() {
        try {
            const { status } = await http.delete("/produtos/".concat(produtoParaDeletar.value?.uuid))

            if (status !== 204) {
                toast.error("Erro ao deletar o produto")

                return
            }

            dialogoDelecao.value?.close()

            toast.success("Produto deletado com sucesso")
        } catch (error) {
            toast.error("Erro ao deletar o produto")
        }
    }

    return {
        dialogoDelecao,
        deletar,
        produtoParaDeletar,
        cancelarDelecao,
        confirmarDelecao
    }
}
