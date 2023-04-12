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
            <td class="parking_lot_id">{{parkingLot.parking_lot_id}}</td>
            <td>{{parkingLot.open_time}}</td>
            <td>{{parkingLot.close_time}}</td>
            <td class="status">{{parkingLot.status}}</td>
            <td>{{parkingLot.content}}</td>
            <td>
                <RouterLink :to="`/parkingLot/${parkingLot.parking_lot_id}/details`">Details</RouterLink>
                <a class="edit" href="">Edit</a>   
                <a class="delete" href="">Delete</a>    
            </td>
        </tr>
    </table><br>
    <button>
        <a href="">Reserve</a>
    </button>
    <button>
        <a href="">Back To Admin Home</a>
    </button>
</template>

<script>
import axios from 'axios';

    const getAllParkingLot = async()=>{
        try {
            const response = await axios.get('/api/parkingLot/allData')
            const data = response.data

            return data
        }
        catch(error) {
            console.log(error);
        }
    }

    export default {
        name: 'parkingLots',
        async setup() {
            const parkingLotDataList = await getAllParkingLot()

            return {
                parkingLotDataList
            }
        },
        // data() {
        //     const route = useRoute()
        //     const router = useRouter()

        //     return {
        //         route,
        //         router
        //     }
        // },
        mounted() {
            console.log('Mounted');
        },
        beforeCreate() {
            console.log('Before Create');
        },
        created() {
            console.log('Created');
        },
        beforeMount() {
            console.log('Before Mount');
        },
        beforeUnmount() {
            console.log('Before Unmount');
        },
        unmounted() {
            console.log('Unmounted');
        }
    }
</script>