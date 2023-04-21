<template>
    <div>
        <h1>Dashboard</h1>
        {{ $store.state.user.userInfo.name }}

        <el-button @click="handleLogout">Logout</el-button>
    </div>
</template>

<script setup>

    import { messageBox,notification } from '$/modules/util'
    import { logout } from '$/api/manager'
    import { useRouter } from 'vue-router'
    import { useStore } from 'vuex'

    const router = useRouter()
    const store = useStore()

    function handleLogout() {
        messageBox('Confirm Logout?','Warning','warning').then(response=>{
            logout().finally(()=>{
                // Redirect To Login Page
                router.push('/login')
                // Remove User State
                store.dispatch('logout')
                // Show Notification
                notification('Success','Logout Successfully','success')
            })
        })    
    }
</script>