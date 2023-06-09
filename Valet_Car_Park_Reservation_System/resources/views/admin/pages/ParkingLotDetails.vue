<template>
    <div>
        <h1>Parking Lot Details</h1>
    </div>

    <h4>Parking Lot ID : {{ parkingLotDetails[0][0].parking_lot_id }}</h4>
    <hr>
    <h4 v-if="parkingLotDetails[0][0].status == 1">Status : Open</h4>
    <h4 v-else>Status : Closed</h4>
    <hr>
    <h4>Available Parking Space :
        <div>
            <p v-if="parkingLotDetails[0][0].parking_space_id" v-for="parkingSpace in parkingLotDetails[0]">{{ parkingSpace.parking_space_id }}</p>
            <p v-else>DID NOT HAD ANY PARKING SPACE UNDER THIS PARKING LOT</p>           
        </div> 
    </h4>
    <hr>
    <h4>Open Time : {{ parkingLotDetails[0][0].open_time }}</h4>
    <h4>Close Time : {{ parkingLotDetails[0][0].close_time }}</h4>
    <hr>
    <h4>Create Time : {{ parkingLotDetails[0][0].created_at }}</h4>
    <h4>Update Time : {{ parkingLotDetails[0][0].updated_at }}</h4>
    <hr>
    <h4>Comment History :
        <div>
            <p v-if="parkingLotDetails[1][0].content" v-for="comments in parkingLotDetails[1][0]">Comment Time "{{ comments.created_at }}" : {{ comments.content }}</p>
            <p v-else>DID NOT HAD ANY COMMENTS HISTORY</p>
        </div>
        
    </h4>
</template>

<script>
    import { useRoute } from 'vue-router'
    import axios from 'axios'

    const getParkingLotDetails = async(parkingLotId)=>{
        try {
            const response = await axios.get('/api/parkingLot/'+parkingLotId+'/details')
            const dataList = response.data

            return dataList
        }
        catch(error) {
            console.log(error);
        }
    }

    export default {

        name: 'parkingLotDetails',
        async setup() {

            const route = useRoute()
            const parkingLotId = route.params.parkingLotId
            
            const parkingLotDetails = await getParkingLotDetails(parkingLotId)

            return {
                parkingLotDetails
            }
        }
    }
</script>