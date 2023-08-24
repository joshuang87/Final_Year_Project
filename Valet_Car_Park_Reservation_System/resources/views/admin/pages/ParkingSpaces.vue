<template>
    <div>
        <div>
            <h1>Parking Spaces Data</h1>
            <el-button @click="resetDateFilter">reset date filter</el-button>
            <el-button @click="clearFilter">reset all filters</el-button>
        </div>

        <div>
            <el-table :data="parkingSpaceDataList" border fit>
                <el-table-column prop="parking_space_id" label="Parking Space Id" />
                <el-table-column prop="parking_lot_id" label="Parking Lot Id" />
                <el-table-column prop="open_time" label="Open Time" />
                <el-table-column prop="close_time" label="Close Time" />
                <el-table-column fixed="right" label="Operations">
                    <template #default>
                        <el-button text type="danger" icon="Delete" @click="">Delete</el-button>
                    </template>
                </el-table-column>
            </el-table>

            <!-- <template>
                <el-table :data="tableData" border style="width: 100%">
                    <el-table-column prop="date" label="Date" width="180" />
                    <el-table-column prop="name" label="Name" width="180" />
                    <el-table-column prop="address" label="Address" />
                </el-table>
            </template> -->
        </div>
    </div>
</template>

<script setup>
    import axios from 'axios'
    import { ref } from 'vue'

    const parkingSpaceDataList = ref([])

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

    const data = await getAllParkingSpaces()
    parkingSpaceDataList.value = data

    console.log(parkingSpaceDataList.value)

</script>
