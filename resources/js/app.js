import { createApp } from 'vue'
import { createPinia } from 'pinia'
import router from './router/index'
import App from './pages/App.vue'
import { useAuthStore } from './stores/auth'
import axios from 'axios'

axios.defaults.baseURL = 'http://127.0.0.1:8000'

const app   = createApp(App)
const pinia = createPinia()

app.use(pinia)
app.use(router)

const auth = useAuthStore()
auth.init()

app.mount('#app')