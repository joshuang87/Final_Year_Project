import './bootstrap';
import router from './router'
import { createApp } from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';

// import ExampleComponent from './components/ExampleComponent.vue';
// import TestAdminHome from './components/TestAdminHome.vue';
// import Testing from './components/Testing.vue';
// import Home from '../views/vueTest/components/Home.vue'
import App from '../views/vueTest/App.vue'

const app = createApp(App);

app.use(router)
app.use(VueAxios,axios)
app.provide('axios',app.config.globalProperties.axios)
app.mount('#app');


// app.component('example-component', ExampleComponent);
// app.component('test-admin-home', TestAdminHome);
// app.component('testing', Testing);