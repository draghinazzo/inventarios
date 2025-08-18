import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

// Bootstrap
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue-next/dist/bootstrap-vue-next.css'
import 'bootstrap/dist/js/bootstrap.bundle.min.js' // 👈 Esto activa los dropdowns

import 'bootstrap-icons/font/bootstrap-icons.css'

import {
    BCard,
    BButton,
    BTable,
    BModal,
    BForm,
    BFormGroup,
    BFormInput,
    BFormSelect,
    BDropdown,
    BDropdownItem,
    BDropdownDivider

  } from 'bootstrap-vue-next'


const app = createApp(App)
app.use(router)

app.component('b-card', BCard)
app.component('b-button', BButton)
app.component('b-table', BTable)
app.component('b-modal', BModal)
app.component('b-form', BForm)
app.component('b-form-group', BFormGroup)
app.component('b-form-input', BFormInput)
app.component('b-form-select', BFormSelect)
app.component('b-dropdown', BDropdown)
app.component('b-dropdown-item', BDropdownItem)
app.component('b-dropdown-divider', BDropdownDivider)


app.mount('#app')
