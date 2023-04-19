<template>
    <div>
        <h1>Parking Spaces Data</h1>
    </div>

    <div>
       {{  parkingSpacesDataList }}
    </div>
</template>

<script>
    import axios from 'axios'

    const getAllParkingSpaces = async()=>{
        try {
            const response = await axios.get('/api/parkingSpace/allData')
            const data = response.data

            return data
        }
        catch(error) {
            console.log(error)
        }
    }

    export default {
        async setup() {
            const parkingSpacesDataList = await getAllParkingSpaces()

            return {
                parkingSpacesDataList
            }
        }
    }
</script>