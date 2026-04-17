import http from '@/services/http.ts'
import { ref } from 'vue'

export default function useUpdateCategories() {
    const data = ref({})
    const err = ref(false)
    const requestIsRunning = ref(false)
    const modalUpdateRef = ref<null | HTMLDialogElement>(null)
    const objectUpdate = ref({})

    // async function handle() {
    //     try {
    //         const { status, data: response } = await http.get('/categorias')

    //         if (status !== 200) {
    //             err.value = true
    //             data.value = []

    //             return
    //         }

    //         // console.log(data.data)

    //         data.value = response.data
    //         err.value = false
    //     } catch (error) {
    //         data.value = []
    //         err.value = true
    //     } finally {
    //         requestIsRunning.value = false
    //     }
    // }

    function toUpdate(categoria) {
        modalUpdateRef?.value?.showModal()

        objectUpdate.value = categoria
    }

    function cancelUpdate() {
        modalUpdateRef?.value?.close()
    }

    async function confirmUpdate(callback) {
        try {
            requestIsRunning.value = true

            const { data, status } = await http.patch('/categorias/'.concat(objectUpdate.value?.uuid), {
                nome: objectUpdate.value.nome,
                descricao: objectUpdate.value.descricao,
                status: objectUpdate.value.status,
            })

            callback()
        } catch (error) {
            err.value = true
        } finally {
            requestIsRunning.value = false
        }
    }

    return { toUpdate, modalUpdateRef, objectUpdate, cancelUpdate, confirmUpdate }
}
