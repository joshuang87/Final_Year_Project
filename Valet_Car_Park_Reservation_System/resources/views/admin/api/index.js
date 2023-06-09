import axios from '$/axios'

export function getTotalReservation() {
    return axios.get('/api/admin/getTotalReservation')
}