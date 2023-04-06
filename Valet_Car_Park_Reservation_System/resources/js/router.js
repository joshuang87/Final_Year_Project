// Import Vue Router
import { createRouter,createWebHashHistory } from 'vue-router'

// Define A Router Object
const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        {
            path: '/',
            name: 'home',
            component: ()=> import('../views/vueTest/components/Home.vue')
        },
        {
            path: '/about',
            name: 'about',
            component: ()=> import('../views/vueTest/components/About.vue')
        },
        {
            path: '/allParkingLot',
            name: 'allParkingLot',
            component: ()=> import('../views/vueTest/components/AllParkingLot.vue')
        }
    ]
})

// Modular Router Object
export default router