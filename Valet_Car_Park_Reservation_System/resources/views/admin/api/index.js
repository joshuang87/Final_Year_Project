import axios from '$/axios'

export function getTotalReservation() {
    return axios.get('/api/admin/getTotalReservation')
}

export function getData() {
    return axios.get('/api/test')
}

export function getParkingLotData() {
    return axios.get('api/parkingLot/allData')
}