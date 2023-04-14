<template>
    <h1>Parking Lot Data Edit</h1>

    
        <label for="parking_lot_id">Parking Lot ID : </label>
        <input type="text" name="parking_lot_id" id="parking_lot_id" v-model="dataForm.parking_lot_id">{{ dataForm.parking_lot_id }}
        <br>
        <label for="status">Status : </label>
        <select name="status" id="status" v-model="dataForm.status">
            <option id="option1" value="1" v-if="dataForm.status == 1" selected>Open</option>
            <option id="option1" value="0" v-else selected>Closed</option>
            <option id="option2" value="0"  v-if="dataForm.status == 1">Closed</option>
            <option id="option2" value="1" v-else>Open</option>
        </select>
        <br>
        <label for="comment">Comment : </label>
        <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Make Some Comment Before Update The ." v-model="dataForm.content"></textarea>
        <br>
        <label for="open_time">Open Time : </label>
        <input type="time" name="open_time" id="open_time" step="1" v-model="dataForm.open_time">
        <br>
        <label for="close_time">Close Time : </label>
        <input type="time" name="close_time" id="close-time" step="1" v-model="dataForm.close_time">
        <br>
        <button @click="updateData(dataForm.parking_lot_id)">Update</button>
        {{ dataForm }}
    
</template>

<script>
    import { useRoute } from 'vue-router'
    import { ref,reactive } from 'vue'
    import axios from 'axios'

    const getSpecificParkingLotData = async(parkingLotId)=>{
        try {
            const response = await axios.get('/api/parkingLot/'+parkingLotId+'/details')
            const data = response.data[0][0]

            return data
        }
        catch(error) {
            console.log(error);
        }
    }

    export default {

        name: 'parkingLotEdit',
        async setup() {

            const route = useRoute()
            const parkingLotId = route.params.parkingLotId

            const specificParkingLotData = await getSpecificParkingLotData(parkingLotId)

            const dataForm = ref({
                parking_lot_id: specificParkingLotData.parking_lot_id,
                status: specificParkingLotData.status,
                open_time: specificParkingLotData.open_time,
                close_time: specificParkingLotData.close_time,
                content: ''
            })

            // dataForm.value = specificParkingLotData
            // console.log(dataForm.value);
            // console.log(dataForm);
            console.log(dataForm.value);

            // const showData = ()=>{
            //     console.log(dataForm.value);
            // }

            return {
                dataForm,
                // showData
            }
        },
        methods: {
            async updateData(parkingLotId){
                const data = {
                    parking_lot_id: this.dataForm.parking_lot_id,
                    status:  this.dataForm.status,
                    open_time: this.dataForm.open_time,
                    close_time: this.dataForm.close_time,
                    content: this.dataForm.content
                }
                console.log(data);
                try {
                    await axios.patch('/api/parkingLot/'+parkingLotId+'/update')
                }
                catch(error) {
                    console.log(error);
                }
            },
            // showData(id){
            //     console.log(id);
            // }
        },
        mounted() {
            // this.updateData()
            // this.showData()
        }
    }
</script>