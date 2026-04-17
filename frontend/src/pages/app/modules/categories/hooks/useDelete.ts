import http from '@/services/http.ts'
import { ref } from 'vue'

export default function useDeleteCategories() {

    const objectToDelete = ref({})
    const requestIrRunning = ref(false)
    const modalDeleteRef = ref<HTMLDialogElement | null>(null)

    async function confirmDelete(callback: Function) {
        try {
            await http.delete('/categorias/'.concat(objectToDelete.value?.uuid))

            callback()
        } catch (error) {
            closeDeleteDialog()
        } finally {
            requestIrRunning.value = false
        }
    }

    function toDelete(categoria) {
        objectToDelete.value = categoria

        if (modalDeleteRef.value) {
            modalDeleteRef.value.showModal()
        }
    }


    function closeDeleteDialog() {
        if (modalDeleteRef.value) {
            modalDeleteRef.value.close()
        }
    }

    return { objectToDelete, requestIrRunning, confirmDelete, closeDeleteDialog, toDelete, modalDeleteRef }
}
