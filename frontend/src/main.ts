import { createApp } from 'vue'

import App from './App.vue'
import router from './router'
import '@steveyuowo/vue-hot-toast/vue-hot-toast.css'

const app = createApp(App)

app.use(router)

app.mount('#app')
