<template>
    <div>
        <div>
            <h1>Parking Spaces Data</h1>
            <el-button @click="clearFilter">reset all filters</el-button>
            <!-- <el-input v-model="search" placeholder="Type to search parking space"/> -->
        </div>

        <div>
            <el-table ref="tableRef" :data="parkingSpaceDataList" border fit>
                <el-table-column prop="parking_space_id" label="Parking Space Id" />
                <el-table-column prop="parking_lot_id" label="Parking Lot Id" />
                <el-table-column prop="open_time" label="Open Time" />
                <el-table-column prop="close_time" label="Close Time" />
                <el-table-column
                    prop="parking_lot_id"
                    label="Parking Lot Id"
                    width="100"
                    :filters="filters"
                    :filter-method="filterTag"
                    filter-placement="bottom-end"
                >
                    <template #default="scope">
                        <el-tag disable-transitions>
                            {{ scope.row.parking_lot_id }}
                        </el-tag>
                    </template>
                </el-table-column>
                <el-table-column fixed="right" label="Operations">
                    <template #default="props">
                        <el-button text type="danger" icon="Delete" @click="deleteParkingSpace(props.row.parking_space_id)">Delete</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </div>
    </div>
</template>

<script setup>
    import axios from 'axios'
    import { ref,computed } from 'vue'

    const parkingSpaceDataList = ref([])
    const parkingLotDataList = ref([])
    const filters = ref([])
    const tableRef = ref()
    const search = ref('')

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

    const parkingSpacesData = await getAllParkingSpaces()
    parkingSpaceDataList.value = parkingSpacesData

    const filterTableData = computed(() => {
        parkingSpacesData.filter(
            (data) => 
                !search.value || data.parking_space_id.toLowerCase().includes(search.value.toLowerCase())  
        )
    })

    const getAllParkingLot = async() => {
        try {
            const response = await axios.get('api/parkingLot/allData')
            const data = response.data

            return data
        }
        catch(err) {
            console.log(err);
        }
    }

    const parkingLotData = await getAllParkingLot()
    parkingLotDataList.value = parkingLotData

    parkingLotDataList.value.forEach(filtersArray)
    function filtersArray(val) {
        filters.value.push(
            {
                text: val.parking_lot_id,
                value: val.parking_lot_id
            }
        )
    }
    
    const filterTag = (value,row) => {
        return row.parking_lot_id === value
    }

    const clearFilter = () => {
        tableRef.value.clearFilter()
    }

    const deleteParkingSpace = async(parkingSpaceId) => {
        try {
            const index = parkingSpaceDataList.value.findIndex(parkingSpace => parkingSpace.parking_space_id == parkingSpaceId)
            parkingSpaceDataList.value.splice(index,1)
            await axios.delete('api/parkingSpace/' + parkingSpaceId + '/delete')
        }
        catch(err) {
            console.log(err);
        }
    }
    console.log(parkingLotDataList.value);

</script>
