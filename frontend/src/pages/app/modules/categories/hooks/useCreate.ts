import http from '@/services/http.ts'
import { ref } from 'vue'

export default function useUpdateCategories() {
    const form = ref({})
    const requestIsRunning = ref(false)
    const dialog = ref<null | HTMLDialogElement>(null)

    async function create(callback: Function) {
        try {
            const response = await http.post('/categorias', {
                nome: form.value?.nome,
                descricao: form.value?.descricao,
                status: form.value?.status,
            })

            callback()
        } catch (error) {

        } finally {
            requestIsRunning.value = false
        }
    }

    function closeDialog() {
        if (dialog.value) {
            dialog.value.close()
        }
    }

    function openCreateForm() {
        if (dialog.value) {
            dialog.value.showModal()
        }
    }


    return {
        form,
        requestIsRunning,
        dialog,
        create,
        closeDialog,
        openCreateForm
    }
}
