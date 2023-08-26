import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'
import Vuex from 'vuex'
import store from './store'
import { loadStripe } from '@stripe/stripe-js'
import axios from 'axios'
import VueGridLayout from 'vue-grid-layout'

const app = createApp(App)

app.use(router)
app.use(Vuex)
app.use(store)
// app.use(VueGridLayout)
app.mount('#app')
