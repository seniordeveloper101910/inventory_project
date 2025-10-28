import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import './index.css'
import { initSocket } from './services/socket'

const app = createApp(App)
app.use(store)
app.use(router)
initSocket(store)
app.mount('#app')
