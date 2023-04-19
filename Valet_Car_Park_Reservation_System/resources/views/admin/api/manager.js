import axios from 'axios'

export function login(name,password) {
    return axios.post('/api/checkLogin',{
        name,
        password
    })
}