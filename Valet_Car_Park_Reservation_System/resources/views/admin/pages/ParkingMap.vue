<template>
    <div>
        <button @click="addFormVisible = true" class="btn btn-primary" style="margin-bottom: 5px;">Add Parking Space</button>
        <div v-if="draggable" class="form-check form-switch">
            <input type="checkbox" v-model="draggable" class="form-check-input"/> Edit Mode (ON)
        </div>
        <div v-else class="form-check form-switch">
            <input type="checkbox" v-model="draggable" class="form-check-input"/> Edit Mode (OFF)
        </div>
        <div class="form-check form-switch">
            <input type="checkbox" v-model="resizable" class="form-check-input"/> Resizable
        </div>
        <div class="form-check form-switch">
            <input type="checkbox" v-model="collision" class="form-check-input"/> Collision
        </div>

        <div>
            <button @click="saveLayout" class="btn btn-primary" style="margin-bottom: 20px;">Save</button>
        </div>

        <grid-layout :layout.sync="layout"
                     :col-num="colNum"
                     :row-height="80"
                     :is-draggable="draggable"
                     :is-resizable="resizable"
                     :vertical-compact="false"
                     :prevent-collision="collision"
                     :use-css-transforms="true"
                     class="grid"
        >
            <grid-item v-for="item in layout"
                       :static="item.static"
                       :x="item.x"
                       :y="item.y"
                       :w="item.w"
                       :h="item.h"
                       :i="item.i"
                       :key="item.i"
                       style="background-color: RGB(75, 181,67);"
            >
                <button @click="edit(item.i)">
                    {{ item.parking_space_id }}
                </button>
                <span class="remove" @click="removeItem(item.i)">
                    x
                </span>
            </grid-item>
        </grid-layout>

        <br>


        <!-- EDIT FORM -->
        <el-dialog
            v-model="centerDialogVisible"
            title="Parking Space Information Edit"
            align-center
            draggable
        >
            <el-form>
                <el-form-item label="Parking Space ID : ">
                    <el-input clearable v-model="parkingSpaceDetails.parking_space_id"/>
                </el-form-item>
                <el-form-item label="Status : ">
                    <el-radio-group v-model="parkingSpaceDetails.status">
                        <el-radio :label="1">Open</el-radio>
                        <el-radio :label="0">Close</el-radio>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="Comment : ">
                    <el-input type="textarea" placeholder="Please Write Some Comment Before Update Information" autosize clearable/>
                </el-form-item>
                <el-form-item label="Open Time : ">
                    <el-input type="time" step="1" v-model="parkingSpaceDetails.open_time"/>
                </el-form-item>
                <el-form-item label="Close Time : ">
                    <el-input type="time" step="1" v-model="parkingSpaceDetails.close_time"/>
                </el-form-item>
            </el-form>
            <template #footer>
                <span class="dialog-footer">
                    <el-button @click="centerDialogVisible = false">
                        Cancel
                    </el-button>
                    <el-button type="primary" @click="centerDialogVisible = false">
                        Update
                    </el-button>
                </span>
            </template>
        </el-dialog>

        <!-- ADD FORM -->
        <el-dialog
            v-model="addFormVisible"
            title="Parking Space Create Form"
            align-center
            draggable
        >
            <el-form>
                <el-form-item label="Parking Space ID : ">
                    <el-input clearable v-model="createParam.parking_space_id"/>
                </el-form-item>
                <el-form-item label="Status : ">
                    <el-radio-group v-model="createParam.status">
                        <el-radio :label="1">Open</el-radio>
                        <el-radio :label="0">Close</el-radio>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="Open Time : ">
                    <el-input type="time" step="1" v-model="createParam.open_time"/>
                </el-form-item>
                <el-form-item label="Close Time : ">
                    <el-input type="time" step="1" v-model="createParam.close_time"/>
                </el-form-item>
            </el-form>
            <template #footer>
                <span class="dialog-footer">
                    <el-button @click="addFormVisible = false">
                        Cancel
                    </el-button>
                    <el-button type="primary" @click="addItem">
                        Conform
                    </el-button>
                </span>
            </template>
        </el-dialog>
    </div>
</template>

<script setup>
    import axios from 'axios';
    import { ref,onMounted,watchEffect } from 'vue'
    import { useStore } from 'vuex'

    const store = useStore()

    const draggable = ref(false)
    const resizable = ref(false)
    const collision = ref(true)
    const centerDialogVisible = ref(false)
    const addFormVisible = ref(false)

    const layout = ref(null)
    const parkingSpaceDetails = ref(null)
    const createParam = ref(
        {
            parking_lot_id: null,
            parking_space_id: null,
            status: null,
            open_time: null,
            close_time: null
        }
    )

    let parkingLotId = store.state.parkingLotId

    const getAllParkingSpacesData = async() => {
        try {
            const response = await axios.get('api/parkingSpace/filter/' + parkingLotId)
            const data = response.data

            return data
        }
        catch(error) {
            console.log(error)
        }
    }

    const parkingSpaces = await getAllParkingSpacesData()
    const specificParkingSpaceData = parkingSpaces.filter(item => item.parking_lot_id === parkingLotId)

    layout.value = specificParkingSpaceData

    let colNum = 12
    let index = 0
    let x = 0

    onMounted(async() => {

        index = layout.value.length
        console.log(parkingSpaces)

    })

    watchEffect(async() => {

        let parkingLotId = store.state.parkingLotId

        const getAllParkingSpacesData = async() => {
            try {
                const response = await axios.get('api/parkingSpace/filter/' + parkingLotId)
                const data = response.data

                return data
            }
            catch(error) {
                console.log(error)
            }
        }

        const parkingSpaces = await getAllParkingSpacesData()
        const specificParkingSpaceData = parkingSpaces.filter(item => item.parking_lot_id === parkingLotId)

        layout.value = specificParkingSpaceData
        console.log(specificParkingSpaceData)

    })

    const addItem = () => {
        // Add a new item. It must have a unique key!
        layout.value.push(
            {
                parking_lot_id: store.state.parkingLotId,
                parking_space_id: createParam.value.parking_space_id,
                status: createParam.value.status,
                open_time: createParam.value.open_time,
                close_time: createParam.value.close_time,
                x: x,
                y: 0,
                w: 1,
                h: 1,
                i: createParam.value.parking_space_id
            }
        )
        createParam.value.parking_lot_id = null
        createParam.value.parking_space_id = null
        createParam.value.status = null
        createParam.value.open_time = null
        createParam.value.close_time = null

        addFormVisible.value = false
        // Increment the counter to ensure key is always unique.
        x++
        console.log(layout.value);
    }

    const removeItem = async(val) => {
        const index = layout.value.map(item => item.i).indexOf(val)
        let parkingSpaceId = layout.value[index].parking_space_id
        layout.value.splice(index, 1)
        await axios.delete('api/parkingSpace/' + parkingSpaceId + '/delete')
    }

    const edit = async(val) => {
        const index = layout.value.map(item => item.i).indexOf(val)
        parkingSpaceDetails.value = layout.value[index]
        centerDialogVisible.value = true
    }

    const saveLayout = async()=>{
        console.log(layout.value)
        await axios.post('api/parkingSpace/updateLayout',layout.value)
    }

</script>

<style>
.layoutJSON {
    background: #ddd;
    border: 1px solid black;
    margin-top: 10px;
    padding: 10px;
}

.columns {
    -moz-columns: 120px;
    -webkit-columns: 120px;
    columns: 120px;
}

/*************************************/

.remove {
    position: absolute;
    right: 2px;
    top: 0;
    cursor: pointer;
}

.vue-grid-layout {
    background: #eee;
}

.vue-grid-item:not(.vue-grid-placeholder) {
    background: #ccc;
    border: 1px solid black;
}

.vue-grid-item .resizing {
    opacity: 0.9;
}

.vue-grid-item .static {
    background: #cce;
}

.vue-grid-item .text {
    font-size: 24px;
    text-align: center;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    height: 100%;
    width: 100%;
}

.vue-grid-item .no-drag {
    height: 100%;
    width: 100%;
}

.vue-grid-item .minMax {
    font-size: 12px;
}

.vue-grid-item .add {
    cursor: pointer;
}

.vue-draggable-handle {
    position: absolute;
    width: 20px;
    height: 20px;
    top: 0;
    left: 0;
    background: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='10'><circle cx='5' cy='5' r='5' fill='#999999'/></svg>") no-repeat;
    background-position: bottom right;
    padding: 0 8px 8px 0;
    background-repeat: no-repeat;
    background-origin: content-box;
    box-sizing: border-box;
    cursor: pointer;
}

.grid::before {
    content: '';
    background-size: calc(calc(100% - 5px) / 12) 40px;
    background-image: linear-gradient(
            to right,
            lightgrey 1px,
            transparent 1px
        ),
        linear-gradient(to bottom, lightgrey 1px, transparent 1px);
    height: calc(85% - 5px); /* Adjusted to exclude top 20% */
    width: calc(100% - 5px);
    position: absolute;
    background-repeat: repeat;
    margin: 5px;
    top: 15%; /* Position at the top of the remaining 80% */
}

.vue-grid-item.vue-grid-placeholder {
    background: green !important;
}

</style>
