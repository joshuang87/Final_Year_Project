import router from '$/router'
import { getToken } from '$/modules/auth'
import { notification,showFullLoading,hideFullLoading } from '$/modules/util'
import store from './store'

let hasGetIfo = false

router.beforeEach(async(to,from,next)=>{
    
    // Show Loading Animation
    showFullLoading()

    const token = getToken()
    // If Did't Had Login, Then Redirect To Login Page
    if(!token && to.path != '/login') {
        notification('Unauthorized','Please Login Your Account','error')
        return next({ path: '/login' })
    }
    // Avoid Repeat Login
    if(token && to.path == '/login') {
        notification('Warning','Your Are Already Login','warning')
        return next({ path: from.path ? from.path: '/' })
    }
    // If User Logged, User Data Will Store In vuex
    if(token && !hasGetIfo) {
        await store.dispatch('getInfo')
        // Avoid Repeat Execute getInfo function
        hasGetIfo = true
    }
    // Setting Page Title
    let title = to.meta.title ? to.meta.title : 'Title'
    document.title = title
    next()
})

router.afterEach((to,from)=>{
    hideFullLoading()
})