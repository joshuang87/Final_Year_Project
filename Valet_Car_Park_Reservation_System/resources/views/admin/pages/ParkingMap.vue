<template>
    <div>
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
            >
                <button @click="test(item.i)">
                    {{ item.i }}
                </button>
                <span class="remove" @click="removeItem(item.i)">
                    x
                </span>
            </grid-item>
        </grid-layout>

        <br>
        <button @click="addItem">Add Parking Space</button>
        <div v-if="draggable">
            <input type="checkbox" v-model="draggable"/> Edit Mode (ON)
        </div>
        <div v-else>
            <input type="checkbox" v-model="draggable"/> Edit Mode (OFF)
        </div>
        
        <input type="checkbox" v-model="resizable" /> Resizable
        <input type="checkbox" v-model="collision" /> Collision

        <!-- EDIT FORM -->
        <el-dialog
            v-model="centerDialogVisible"
            title="Parking Space Information Edit"
            align-center
            draggable
        >
            <el-form>
                <el-form-item label="Parking Space ID : ">
                    <el-input clearable/> {{ parkingSpaceDetails.parking_space_id }}
                </el-form-item>
                <el-form-item label="Status : ">
                    <el-radio-group>
                        <el-radio :label="1">Open</el-radio>
                        <el-radio :label="0">Close</el-radio>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="Comment : ">
                    <el-input type="textarea" placeholder="Please Write Some Comment Before Update Information" autosize clearable/>
                </el-form-item>
                <el-form-item label="Open Time : ">
                    <el-input type="time" step="1"/>
                </el-form-item>
                <el-form-item label="Close Time : ">
                    <el-input type="time" step="1"/>
                </el-form-item>
            </el-form>
            <template #footer>
                <span class="dialog-footer">
                    <el-button @click="centerDialogVisible = false">Cancel</el-button>
                    <el-button type="primary" @click="centerDialogVisible = false">
                        Confirm
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

    const layout = ref(null)
    const parkingSpaceDetails = ref(null)

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
        layout.value.push({
            // x: (layout.value.length * 2) % (colNum || 12),
            x: x,
            // y: layout.value.length + (colNum || 12), // puts it at the bottom
            y: 0,
            w: 1,
            h: 1,
            i: null,
        })
        // Increment the counter to ensure key is always unique.
        x++
        console.log(layout.value);
    }

    const removeItem = (val) => {
        const index = layout.value.map(item => item.i).indexOf(val)
        layout.value.splice(index, 1)
    }

    const test = async(val) => {
        const index = layout.value.map(item => item.i).indexOf(val)
        parkingSpaceDetails.value = layout.value[index]
        centerDialogVisible.value = true
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
    height: calc(100% - 5px);
    width: calc(100% - 5px);
    position: absolute;
    background-repeat: repeat;
    margin:5px;
}

.vue-grid-item.vue-grid-placeholder {
    background: green !important;
}

</style>