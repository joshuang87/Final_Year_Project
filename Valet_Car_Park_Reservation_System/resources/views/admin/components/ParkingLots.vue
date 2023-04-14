<template>
    <div>
        <h1>Parking Lot data</h1>
    </div>
    <table border="1">
        <tr>
            <th>Parking Lot ID</th>
            <th>Open Time</th>
            <th>Close Time</th>
            <th>Status</th>
            <th>Comment</th>
            <th>Action</th>
        </tr>

        <tr v-for="parkingLot in parkingLotDataList">
            <td>{{parkingLot.parking_lot_id}}</td>
            <td>{{parkingLot.open_time}}</td>
            <td>{{parkingLot.close_time}}</td>
            <td v-if="parkingLot.status == 1">Open</td>
            <td v-else>Closed</td>
            <td>{{parkingLot.content}}</td>
            <td>
                <RouterLink :to="`/parkingLot/${parkingLot.parking_lot_id}/details`">Details</RouterLink>
                <RouterLink :to="`/parkingLot/${parkingLot.parking_lot_id}/edit`">Edit</RouterLink> 
                <button @click="state.deleteParkingLot(parkingLot.parking_lot_id)">Delete</button>    
            </td>
        </tr>
    </table>
</template>

<script>
    import axios from 'axios';
    import { ref,reactive } from 'vue'

    const getAllParkingLot = async()=>{
        try {
            const response = await axios.get('/api/parkingLot/allData')
            const data = response.data

            return data
        }
        catch(error) {
            console.log(error)
        }
    }

    export default {

        async setup() {

            const parkingLotDataList = ref([])
            parkingLotDataList.value = await getAllParkingLot()

            const state = reactive({
                deleteParkingLot: async(parkingLotId)=>{
                    try {
                        const index = parkingLotDataList.value.findIndex(parkingLot => parkingLot.parking_lot_id == parkingLotId)
                        parkingLotDataList.value.splice(index,1)
                        await axios.delete('/api/parkingLot/'+parkingLotId+'/delete')
                    }
                    catch(error) {
                        console.log(error);
                    }
                }
            })

            return {
                parkingLotDataList,
                state
            }
        }
    }
</script>

<style scoped>
    a {
        margin: 4px;
    }
</style>