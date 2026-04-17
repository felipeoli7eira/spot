import http from "@/services/http"
import { toast } from "@steveyuowo/vue-hot-toast"
import { ref } from "vue"

export default function useCadastro() {
    const listando = ref(false)
    const lista = ref([])

    async function listar() {
        try {
            const { data, status } = await http.get('/produtos')

            if (status !== 200) {
                return
            }

            lista.value = data.data
        } catch (err) {
            console.log(err)

            toast.error("Erro ao listar os produtos cadastrados")
        } finally {
            listando.value = false
        }
    }

    return {
        listando,
        listar,
        lista
    }
}
