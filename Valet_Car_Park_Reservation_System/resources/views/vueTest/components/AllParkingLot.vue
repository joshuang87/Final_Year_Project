<template>
    <h1>All Parking Lot</h1>
    <!-- <table border="1">
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
                <a class="details" href="">Details</a>
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
    </button> -->
    <div>
        {{ parkingLotDataList }}
    </div>
</template>

<script>
import axios from 'axios';

    const allData = async()=>{
        try {
            const res = await axios.get('https://jsonplaceholder.typicode.com/todos/1')
            // const res = await axios.get('/test/fetch/parkL')

            // const parkingLotDataList = res.data
            console.log(res);

            // return parkingLotDataList
            // return res
        }
        catch(err) {
            console.log(err);
        }
        
    }

    export default {
        async setup() {
            const parkingLotDataList = await allData()

            return {
                parkingLotDataList
            }
        },
        data() {
            // return {
            //     parkingLotDataList: []
            // }
        },
        mounted() {

            // async function(){
            //     await axios.get('/test/fetch/parkL').then((response)=>{
            //     this.parkingLotDataList = response.data
            // }).catch((error)=>{
            //     console.log(error);
            // })
            // }
            // axios.get('/test/fetch/parkL').then((response)=>{
            //     this.parkingLotDataList = response.data
            // }).catch((error)=>{
            //     console.log(error);
            // })
            console.log('Mounted');
            
        },
        beforeCreate() {
            console.log('Before Create');
        },
        created() {
            // axios.get('/test/fetch/parkL').then((response)=>{
            //     this.parkingLotDataList = response.data
            //     console.log(this.parkingLotDataList);
            // }).catch((error)=>{
            //     console.log(error);
            // })
            console.log('Created');
        },
        beforeMount() {
            console.log('Defore Mount');
        },
        beforeUnmount() {
            console.log('Before Unmount');
        },
        unmounted() {
            console.log('Unmounted');
        }
    }
</script>