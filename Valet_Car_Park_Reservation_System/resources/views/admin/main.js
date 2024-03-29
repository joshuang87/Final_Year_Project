// import './bootstrap';
import { createApp } from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import * as ElementPlusIconsVue from '@element-plus/icons-vue'
import store from '$/store'
import AdminRouter from '$/router'
import AdminApp from '$/App.vue'
import '$/permission'
import VueGridLayout from 'vue-grid-layout'
// CSS Import
import 'element-plus/theme-chalk/index.css'
import 'element-plus/dist/index.css'
import 'nprogress/nprogress.css'
import 'animate.css'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.min.js'
import 'virtual:windi.css'
import '@icon-park/vue-next/styles/index.css'

const adminApp = createApp(AdminApp);

for (const [key, component] of Object.entries(ElementPlusIconsVue)) {
    adminApp.component(key, component)
  }

adminApp.use(AdminRouter)
adminApp.use(VueAxios,axios)
adminApp.use(store)
adminApp.use(VueGridLayout)
adminApp.provide('axios',adminApp.config.globalProperties.axios)
adminApp.mount('#adminApp')