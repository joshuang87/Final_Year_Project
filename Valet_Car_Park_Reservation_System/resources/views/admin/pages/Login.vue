<template>
    <h1>Login</h1>

    <el-form ref="formRef" :rules="rules" :model="form">
        <el-form-item label="Username" prop="name">
            <el-input v-model="form.name" clearable />
        </el-form-item>
        <el-form-item label="Password" prop="password">
            <el-input v-model="form.password" show-password />
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="onSubmit">Login</el-button>
        </el-form-item>
    </el-form>
</template>

<script setup>
    import { reactive,ref } from 'vue'
    import { login } from '../api/manager.js'
    import { ElNotification } from 'element-plus'

    const form = reactive({
        name: '',
        password: ''
    })

    const formRef = ref(null)

    const rules = {
        name: [
            {
                required: true,
                message: 'Please Enter Your Username',
                trigger: 'blur'
            },
            // {
            //     min: 3,
            //     max: 6,
            //     message: 'Username must between 3~6 letters',
            //     trigger: 'blur'
            // }
        ],
        password: [
            {
                required: true,
                message: 'Please Enter Your Password',
                trigger: 'blur'
            }
        ]
    }

    const onSubmit = ()=> {
        formRef.value.validate((valid)=>{

            if(!valid) {
                return false
            }

            login(form.name,form.password)
                .then((response)=>{
                    console.log(response)
                    ElNotification({
                    title: 'Login Successfully',
                    message: response,
                    type: 'success',
                    duration: 3000
                    })
                })
                .catch((error)=>{
                    ElNotification({
                    title: 'Error',
                    message: error,
                    type: 'error',
                    duration: 3000
                    })
                })
        })
    }
</script>