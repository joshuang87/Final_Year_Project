import axios from '$/axios.js'

// Login Gateway
export function login(name,password) {
    return axios.post('/api/admin/checkUser',{
        name,
        password
    })
}

// Get Logged User Info
export function getInfo() {
    return axios.get('/api/admin/getInfo')
}

export function logout() {
    return axios.post('/api/admin/logout')
}

export function updatePassword(data) {
    return axios.post('/api/admin/updatePassword',data)
}
export function updateProfileImage(){
    return axios.post('/api/admin/updateProfileImage',data)
}