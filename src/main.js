import { createApp } from 'vue'
import './style.css'
import PrimeVue from 'primevue/config'
import 'primevue/resources/themes/saga-blue/theme.css'  // Theme
import 'primevue/resources/primevue.min.css'                   // Core CSS
import 'primeicons/primeicons.css'                            // Icons
import ToastService from 'primevue/toastservice'
import App from './App.vue'

const app = createApp(App)
app.use(PrimeVue)
app.mount('#app')
