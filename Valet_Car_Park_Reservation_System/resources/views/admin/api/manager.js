import axios from '$/axios.js'

// Login Gateway
export function login(name,password) {
    return axios.post('/api/checkUser',{
        name,
        password
    })
}

// Get Logged User Info
export function getInfo() {
    return axios.get('/api/getInfo')
}

export function logout() {
    return axios.post('/api/logout')
}