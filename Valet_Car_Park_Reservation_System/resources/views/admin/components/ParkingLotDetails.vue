<template>
    <div>
        <h1>Parking Lot Details</h1>
    </div>

    <h4>Parking Lot ID : </h4>
    <hr>
    <h4 class="status">Status : </h4>
    <hr>
    <h4>Available Parking Space :
        <div>
            <p class="parking_space_id"></p>           
        </div> 
    </h4>
    <hr>
    <h4>Open Time : </h4>
    <h4>Close Time : </h4>
    <hr>
    <h4>Create Time : </h4>
    <h4>Update Time : </h4>
    <hr>
    <h4>Comment History :
        <div>
            <p class="commentContent">Comment Time</p>
        </div>
        
    </h4>
</template>

<script>

    const getParkingLotDetails = async()=>{
        try {
            const response = await axios.get('/api/'+parkingLotId+'/details')
            const dataList = response.data
        }
        catch(error) {
            console.log(error);
        }
    }

    export default {

    }
</script>