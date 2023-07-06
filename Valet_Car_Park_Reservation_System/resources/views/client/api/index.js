import axios from '$/axios'

export function fetchAllParkingSpacesData() {
    return axios.get('/api/parkingSpace/allData')
}