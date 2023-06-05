<template>
    <h1>Client Choose Parking Lot</h1>
    <div v-for="parkingLot in parkingLots">
        <router-link :to="{name:'test.getParkingLotID',params:{parking_lot_id:parkingLot.parking_lot_id}}">{{parkingLot.parking_lot_id}}</router-link>
    </div>
    
</template>

<script>
    import axios from 'axios';
    import {ref,onMounted} from 'vue';
    

    export default{

        setup(){

            let parkingLots = ref([])
            let selectedParkingLot = ref('')

            onMounted(() =>{
	    		fetchAllParkingLots(),
                getCurrentClientId()
	    	})

            const fetchAllParkingLots = async()=>{

                axios.get('/test/fetch/parkL').then(res=>{
                    parkingLots.value = res.data
                    console.log(res.data);
                }) 
            }


            function getCurrentClientId(){
                var currentClientId = window.location.href.toString().split("=")[1].split("/")[0]
                console.log(currentClientId);
            }

            return{
                fetchAllParkingLots,
                parkingLots,
                getCurrentClientId
            }
        }
    }
</script>