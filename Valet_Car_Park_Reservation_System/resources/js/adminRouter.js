// Import Vue Router
import { createRouter,createWebHashHistory,createWebHistory } from 'vue-router'

// Define A Router Object
const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        {
            path: '/',
            name: 'adminHome',
            component: ()=> import('../views/admin/components/Home.vue')
        },
        {
            path: '/parkingLots',
            name: 'parkingLots',
            component: ()=> import('../views/admin/components/ParkingLots.vue'),
            children: [
                {
                    path: '/:parkingLotId/details',
                    name: 'parkingLotDetails',
                    component: ()=> import('../views/admin/components/ParkingLotDetails.vue')
                }
            ]
        },
        {
            path: '/parkingSpaces',
            name: 'parkingSpaces',
            component: ()=> import('../views/admin/components/ParkingSpaces.vue'),
            children: {
                path: ':parkingSpaceId/details',
                name: 'parkingSpaceDetails',
                component: ()=> import('../views/admin/components/ParkingSpaceDetails.vue')
            }
        },
        {
            path: '/users',
            name: 'users',
            component: ()=> import('../views/admin/components/Users.vue')
        },
        {
            path: '/customers',
            name: 'customers',
            component: ()=> import('../views/admin/components/Customers.vue')
        },
    ]
})

// Modular Router Object
export default router