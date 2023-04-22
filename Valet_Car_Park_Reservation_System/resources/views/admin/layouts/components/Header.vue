<template>
    <el-icon :size="25" @click="collapse">
        <Fold v-if="$store.state.isCollapse == false" />
        <Expand v-else />
    </el-icon>
    <div class="flex-grow-1" />

    <div class="p-2 d-flex align-items-center">
        <el-icon :size="25" @click="toggle">
            <full-screen v-if="!isFullscreen"/>
            <Aim v-else/>
        </el-icon>
    </div>

    <div class="p-2">
        <el-avatar
            :size="35"
            src="https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png"
        />
    </div>
    <div class="d-flex align-items-center p-2">
        <el-dropdown @command="handleCommand">
            <span class="d-flex align-items-center">
                {{ $store.state.user.userInfo.name }}
                <el-icon class="el-icon--right">
                    <arrow-down />
                </el-icon>
            </span>
            <template #dropdown>
                <el-dropdown-menu>
                    <el-dropdown-item>Profile</el-dropdown-item>
                    <el-dropdown-item command="resetPassword">Reset Password</el-dropdown-item>
                    <el-dropdown-item command="logout" divided>Logout</el-dropdown-item>
                </el-dropdown-menu>
            </template>
        </el-dropdown>
    </div>
    
    <el-drawer 
        v-model="showDrawer" 
        title="Reset Password" 
        size="30%"
        :close-on-click-modal="false"
    >
        <el-form ref="formRef" :rules="rules" :model="form" @keyup.enter="onSubmit" label-width="150px">
            <el-form-item label="Old Password" prop="oldPassword">
                <el-input v-model="form.oldPassword" show-password placeholder="Please Input Old Password" type="password"/>
            </el-form-item>
            <el-form-item label="New Password" prop="newPassword">
                <el-input v-model="form.newPassword" show-password placeholder="Please Input New Password" type="password"/>
            </el-form-item>
            <el-form-item label="Confirm Password" prop="confirmPassword">
                <el-input v-model="form.confirmPassword" show-password placeholder="Please Confirm Your Password"/>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit"  :loading="loading">Reset</el-button>
            </el-form-item>
        </el-form>
    </el-drawer>
</template>

<script setup>
    import { ref } from 'vue'
    import { useStore } from "vuex"
    import { useFullscreen } from '@vueuse/core'
    import { useUpdatePassword,useLogout } from '$/modules/useManager' 

    const store = useStore()

    // Drawer State
    const showDrawer = ref(false)

    const collapse = () => {
        store.dispatch("collapse")
    }

    const { isFullscreen,toggle } = useFullscreen()

    const {
        form,
        formRef,
        loading,
        rules,
        onSubmit
    } = useUpdatePassword()

    const {
        handleLogout
    } = useLogout()

    const handleCommand = (response)=>{
        switch(response) {
            case 'logout':
                handleLogout()
                break
            case 'resetPassword' :
                showDrawer.value = true
                break
        }
    }
</script>