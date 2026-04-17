import http from "@/services/http"
import { toast } from "@steveyuowo/vue-hot-toast"
import { ref } from "vue"

export default function useCadastro() {
    const cadastrando = ref(false)
    const resposta = ref({})
    const dialog = ref<null | HTMLDialogElement>(null)
    const dadosParaCadastro = ref<{
        categoria: string,
        nome: string,
        descricao: string
    }>({
        categoria: '',
        nome: '',
        descricao: ''
    })

    function limparCampos() {
        dadosParaCadastro.value = {
            categoria: '',
            nome: '',
            descricao: ''
        }
    }

    async function cadastrar() {
        try {
            cadastrando.value = true

            console.log(dadosParaCadastro.value)

            const { data, status } = await http.post('/produtos', {
                ...dadosParaCadastro.value
            })

            if (status === 201) {
                toast.success("Produto cadastrado")
            }

            limparCampos()
        } catch (error) {
            console.log(error)
        } finally {
            cadastrando.value = false
        }
    }

    function abrirDialogo() {
        if (dialog.value) {
            dialog.value.showModal()
        }
    }

    function fecharDialogo() {
        if (dialog.value) {
            dialog.value.close()
        }
    }

    return {
        cadastrando,
        cadastrar,
        resposta,
        dialog,
        abrirDialogo,
        fecharDialogo,
        dadosParaCadastro
    }
}
