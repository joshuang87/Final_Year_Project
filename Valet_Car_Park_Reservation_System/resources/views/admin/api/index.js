import axios from '$/axios'

export function getTotalReservation() {
    return axios.get('/api/admin/getTotalReservation')
}

export function getData() {
    return axios.get('/api/test')
}