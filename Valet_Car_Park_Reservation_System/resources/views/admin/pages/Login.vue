<template>

    <head>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>

    <br><br><br><br><br><br><br><br>

    <div class="container mt-5">
       <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-body">

                        <h1 class="mb-4" style="text-align: center;">Login</h1>

                        <el-form ref="formRef" :rules="rules" :model="form" @keyup.enter="onSubmit">
                            <el-form-item label="Username" prop="name">
                                <el-input v-model="form.name" clearable />
                            </el-form-item>
                            <el-form-item label="Password" prop="password">
                                <el-input v-model="form.password" show-password />
                            </el-form-item>
                            <el-form-item>
                                    <el-button type="primary" @click="onSubmit" :loading="loading" class="toRight">Login</el-button>
                            </el-form-item>
                        </el-form>

                    </div>
                 </div>
            </div>
        </div>
    </div>




</template>

<script setup>
    import { reactive,ref } from 'vue'
    import { notification } from '$/modules/util.js'
    import { useRouter,onBeforeRouteUpdate } from 'vue-router'
    import { useStore } from 'vuex'

    const router = useRouter()
    const store = useStore()

    // Initiate The Form Values
    const form = reactive({
        name: '',
        password: ''
    })

    const formRef = ref(null)

    const loading = ref(false)

    // Setting The Rules For The Form
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
            loading.value = true

            store.dispatch('login',form).then((response)=>{
                router.push('/')
                notification('Success',response.message,'success')
            })
            .finally(()=>{
                loading.value = false
            })
        })
    }
</script>

<style>

.login-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.login-form {
    width: 400px;
    margin-top: 20px;
}

.el-form-item {
    margin-bottom: 20px;
}

.el-form-item__label {
    text-align: left;
    font-weight: bold;
}

.el-form-item__content {
    text-align: left;
}

.toRight {
        margin-left: auto;
    }
</style>