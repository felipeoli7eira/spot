import http from '@/services/http.ts'
import { ref } from 'vue'

export default function useReadCategories() {
    const data = ref([])
    const err = ref(false)
    const requestIsRunning = ref(false)

    async function handle() {
        try {
            const { status, data: response } = await http.get('/categorias')

            if (status !== 200) {
                err.value = true
                data.value = []

                return
            }

            // console.log(data.data)

            data.value = response.data
            err.value = false
        } catch (error) {
            data.value = []
            err.value = true
        } finally {
            requestIsRunning.value = false
        }
    }

    return { handle, data, requestIsRunning }
}
