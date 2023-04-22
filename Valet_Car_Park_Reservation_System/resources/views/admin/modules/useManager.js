import { ref,reactive } from 'vue'
import { logout,updatePassword } from '$/api/manager'
import { useRouter } from 'vue-router'
import { useStore } from "vuex"
import { notification,messageBox } from '$/modules/util'

export function useUpdatePassword() {

    const router = useRouter()
    const store = useStore()
    
    // Initiate The Form Values
    const form = reactive({
        oldPassword: '',
        oldPassword: '',
        confirmPassword: ''
    })

    const formRef = ref(null)

    const loading = ref(false)
    
    // Setting The Rules For The Form
    const rules = {
        oldPassword: [
            {
                required: true,
                message: 'Old Password Can Not Be Empty',
                trigger: 'blur'
            }
        ],
        newPassword: [
            {
                required: true,
                message: 'New Password Can Not Be Empty',
                trigger: 'blur'
            }
        ],
        confirmPassword: [
            {
                required: true,
                message: 'Confirm Password Can Not Be Empty',
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
            updatePassword(form).then((response)=>{

                store.dispatch('logout')
                
                router.push('/login')
                notification('Success','Reset Password Successfully, Please Login Again','success')
            })
            .finally(()=>{
                loading.value = false
            })
        })
    }

    return {
        form,
        formRef,
        loading,
        rules,
        onSubmit
    }
}

export function useLogout() {

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

    return {
        handleLogout
    }
}