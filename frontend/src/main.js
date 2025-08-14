import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

// Bootstrap
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue-next/dist/bootstrap-vue-next.css'
import 'bootstrap/dist/js/bootstrap.bundle.min.js' // 👈 Esto activa los dropdowns
import { BCard, BButton } from 'bootstrap-vue-next'
import 'bootstrap-icons/font/bootstrap-icons.css'

const app = createApp(App)
app.use(router)
app.component('b-card', BCard)
app.component('b-button', BButton)
app.mount('#app')
