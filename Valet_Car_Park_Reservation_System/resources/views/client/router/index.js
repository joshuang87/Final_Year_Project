import { createRouter, createWebHistory,createWebHashHistory } from 'vue-router'
import HomeView from 'V/clientPage/HomeView.vue'

const router = createRouter({
  history: createWebHashHistory(),
  routes: [

    {
      path: '/',
      name: 'home',
      component: HomeView
    },

    {
      path: '/about',
      name: 'about',
      component: () => import('V/clientPage/AboutView.vue')
    },

    {
      path: '/signup',
      name: 'signup',
      component: () => import('V/clientPage/SignUpView.vue')
    },

    {
      path: '/login',
      name: 'login',
      component: () => import('V/clientPage/LoginView.vue')
    },

    {
      path: '/booking',
      name: 'booking',
      component: () => import('V/clientPage/BookingView.vue')
    },

    {
      path: '/payment',
      name: 'payment',
      component: () => import('V/clientPage/PaymentView.vue')
    },

    {
        path: '/paymentTest',
        name: 'paymentTest',
        component: () => import('V/clientPage/PaymentTesting.vue')
    },

  ]
})

export default router
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
