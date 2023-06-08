import './bootstrap';
import { createApp } from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import 'animate.css'
import * as ElementPlusIconsVue from '@element-plus/icons-vue'
// import ExampleComponent from './components/ExampleComponent.vue';
// import TestAdminHome from './components/TestAdminHome.vue';
// import Testing from './components/Testing.vue';
// import Home from '../views/vueTest/components/Home.vue'

// app.component('example-component', ExampleComponent);
// app.component('test-admin-home', TestAdminHome);
// app.component('testing', Testing);

// Admin site
import adminRouter from '../views/admin/router'
import AdminApp from '../views/admin/App.vue'

const adminApp = createApp(AdminApp);

for (const [key, component] of Object.entries(ElementPlusIconsVue)) {
    adminApp.component(key, component)
  }

adminApp.use(adminRouter)
adminApp.use(VueAxios,axios)
adminApp.provide('axios',adminApp.config.globalProperties.axios)
adminApp.mount('#adminApp');