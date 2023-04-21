// Import Vue Router
import { createRouter,createWebHistory,createWebHashHistory } from 'vue-router'

// Define A Router Object
const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        {
            path: '/',
            name: 'adminHome',
            redirect: '/dashboard'
        },
        {
            path: '/:pathMatch(.*)*',
            name: 'pageNotFound',
            component: ()=> import('../pages/404.vue'),
            meta: {
                title: '404 Page Not Found'
            }
        },
        {
            path: '/login',
            name: 'Login',
            component: ()=> import('../pages/Login.vue'),
            meta: {
                title: 'Login'
            }
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: ()=> import('$/layouts/Admin.vue'),
            // Child Route
            children: [{
                path: '/dashboard',
                component: ()=> import('../pages/Index.vue'),
                meta: {
                    title: 'Dashboard'
                }
            }]
            
        },
        {
            path: '/parkingLots',
            name: 'parkingLots',
            component: ()=> import('../pages/ParkingLots.vue')
        },
        {
            path: '/parkingLot/:parkingLotId/details',
            name: 'parkingLotDetails',
            component: ()=> import('../pages/ParkingLotDetails.vue')
        },
        {
            path: '/parkingLot/:parkingLotId/edit',
            name: 'parkingLotEdit',
            component: ()=> import('../pages/ParkingLotEdit.vue')
        },
        {
            path: '/parkingLot/:parkingLotId/delete',
            name: 'parkingLotDelete'
        },
        {
            path: '/parkingSpaces',
            name: 'parkingSpaces',
            component: ()=> import('../pages/ParkingSpaces.vue'),
        },
        {
            path: '/parkingSpace/:parkingSpaceId/details',
            name: 'parkingSpaceDetails',
            component: ()=> import('../pages/ParkingSpaceDetails.vue')
        },
        {
            path: '/users',
            name: 'users',
            component: ()=> import('../pages/Users.vue')
        },
        {
            path: '/customers',
            name: 'customers',
            component: ()=> import('../pages/Customers.vue')
        },
    ]
})

// Modular Router Object
export default router