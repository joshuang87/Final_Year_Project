// import './bootstrap';
import { createApp } from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import * as ElementPlusIconsVue from '@element-plus/icons-vue'
import 'element-plus/dist/index.css'
import store from '$/store'
import AdminRouter from '$/router'
import AdminApp from '$/App.vue'
import '$/permission'
import 'nprogress/nprogress.css'

const adminApp = createApp(AdminApp);

for (const [key, component] of Object.entries(ElementPlusIconsVue)) {
    adminApp.component(key, component)
  }

adminApp.use(AdminRouter)
adminApp.use(VueAxios,axios)
adminApp.use(store)
adminApp.provide('axios',adminApp.config.globalProperties.axios)
adminApp.mount('#adminApp');