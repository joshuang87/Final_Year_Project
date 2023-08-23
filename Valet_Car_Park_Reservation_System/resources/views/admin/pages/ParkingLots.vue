<template>

    <div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1>Parking Lots data</h1>
            </div>

            <div>
                <el-button type="primary" @click="addFormVisible = true" class="addButton"> Add Parking Lot</el-button>
            </div>
        </div>

        <div>
            <el-table :data="parkingLotDataList" border fit >
                <el-table-column type="expand">
                    <template #default="props">
                        <el-row>
                            <el-col :span="12">
                                <div>
                                    <h3 style="margin-left: 10px;">Available Parking Spaces</h3>
                                    <el-table height='220' border :data="filteredParkingSpaces(props.row.parking_lot_id)">
                                        <el-table-column prop="parking_space_id" label="Parking Spaces ID" />
                                    </el-table>
                                </div>
                            </el-col>
                            <el-col :span="12">
                                    <div>
                                        <h3 style="margin-left: 10px;">Comments History</h3>
                                        <el-table height='220' border :data="filteredComments(props.row.parking_lot_id)">
                                            <el-table-column prop="content" label="Comments" />
                                        </el-table>
                                    </div>
                            </el-col>
                        </el-row>
                    </template>
                </el-table-column>
                <el-table-column prop="parking_lot_id" label="ID" sortable align="center" />
                <el-table-column prop="open_time" label="Open Time" align="center"/>
                <el-table-column prop="close_time" label="Close Time" align="center"/>
                <el-table-column prop="status" label="Status" align="center">
                    <template v-slot="{ row }" >
                        <el-tag effect="light" type="danger" round v-if="row.status == 0">
                            Closed
                        </el-tag>
                        <el-tag effect="light" type="success" round v-else-if="row.status == 1">
                            Open
                        </el-tag>
                        <el-tag effect="light" type="warning" round v-else>
                            Undefined State
                        </el-tag>
                    </template>
                </el-table-column>
                <el-table-column prop="content" label="Comment" />
                <el-table-column fixed="right" label="Operations" align="center">
                    <template #default="props">
                        <el-button text type="primary" @click="edit(props.row.parking_lot_id)" icon="Edit">Edit</el-button>
                        <el-button text type="danger" icon="Delete" @click="state.deleteParkingLot(props.row.parking_lot_id)">Delete</el-button>
                    </template>
                  </el-table-column>
            </el-table>
        </div>

        <el-dialog
            v-model="editFormVisible"
            title="Parking Lot Information Edit"
            align-center
            draggable
        >
            <el-form>
                <el-form-item label="Parking Lot ID : ">
                    <el-input clearable v-model="parkingLotData.parking_lot_id"/>
                </el-form-item>
                <el-form-item label="Status : ">
                    <el-radio-group v-model="parkingLotState">
                        <el-radio :label="1">Open</el-radio>
                        <el-radio :label="0">Close</el-radio>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="Comment : ">
                    <el-input type="textarea" placeholder="Please Write Some Comment Before Update Information" autosize clearable v-model="comment"/>
                </el-form-item>
                <el-form-item label="Open Time : ">
                    <el-input type="time" step="1" v-model="parkingLotOpenTime"/>
                </el-form-item>
                <el-form-item label="Close Time : ">
                    <el-input type="time" step="1" v-model="parkingLotCloseTime"/>
                </el-form-item>
            </el-form>
            <template #footer>
                <span class="dialog-footer">
                    <el-button @click="editFormVisible = false">Cancel</el-button>
                    <el-button type="primary" @click="update">Update</el-button>
                </span>
            </template>

        </el-dialog>

        <el-dialog
            v-model="addFormVisible"
            title="Add Parking Lot"
            align-center
            draggable
        >
            <el-form>
                <el-form-item label="Parking Lot ID : ">
                    <el-input clearable v-model="createParam.parking_lot_id"/>
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
                    <el-button @click="addFormVisible = false">Cancel</el-button>
                    <el-button type="primary" @click="add">Add</el-button>
                </span>
            </template>

        </el-dialog>
    </div>
</template>

<script>
    import axios from 'axios';
    import { ref,reactive,computed } from 'vue'
    import { useRoute } from 'vue-router'

    const getAllParkingLot = async()=>{
        try {
            const response = await axios.get('/api/parkingLot/allData')
            const data = response.data

            return data
        }
        catch(error) {
            console.log(error)
        }
    }

    const getAllParkingLotComments = async()=>{
        try {
            const response = await axios.get('/api/comments/allComments')
            const data = response.data

            return data
        }
        catch(error) {
            console.log(error)
        }
    }

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

    export default {

        inject: ['reload'],
        async setup() {

            const route = useRoute()
            const parkingLotDataList = ref([])
            const parkingComments = ref([])
            const parkingSpaces = ref([])
            const comment = ref('')
            const editFormVisible = ref(false)
            const addFormVisible = ref(false)

            const parkingLotData = ref(null)
            const parkingLotState = ref(null)
            const parkingLotOpenTime = ref(null)
            const parkingLotCloseTime = ref(null)

            const createParam = ref(
                {
                    parking_lot_id: null,
                    status: null,
                    open_time: null,
                    close_time: null
                }
            )

            parkingLotDataList.value = await getAllParkingLot()
            console.log(parkingLotDataList.value);

            parkingComments.value = await getAllParkingLotComments()

            parkingSpaces.value = await getAllParkingSpaces()

            const state = reactive({
                deleteParkingLot: async(parkingLotId)=>{
                    try {
                        const index = parkingLotDataList.value.findIndex(parkingLot => parkingLot.parking_lot_id == parkingLotId)
                        parkingLotDataList.value.splice(index,1)
                        await axios.delete('/api/parkingLot/'+parkingLotId+'/delete')
                        console.log(parkingLotId)
                    }
                    catch(error) {
                        console.log(error)
                    }
                }
            })

            const filteredComments = computed(()=> (props)=> {
                return parkingComments.value.filter(comment => comment.parking_lot_id == props)
            })

            const filteredParkingSpaces = computed(()=> (props)=> {
                return parkingSpaces.value.filter(parkingSpace => parkingSpace.parking_lot_id == props)
            })

            const edit = (parkingLotId) => {
                const index = parkingLotDataList.value.map(item => item.parking_lot_id).indexOf(parkingLotId)
                parkingLotData.value = parkingLotDataList.value[index]

                parkingLotState.value = parkingLotData.value.status
                // comment.value = parkingLotData.value.content
                parkingLotOpenTime.value = parkingLotData.value.open_time
                parkingLotCloseTime.value = parkingLotData.value.close_time

                editFormVisible.value = true
                console.log(parkingLotData.value)
            }

            const update = async() => {

                if(comment.value == null) {
                    console.log('NOT COMMENT')
                    editFormVisible.value = false
                }
                else {
                    parkingLotData.value.status = parkingLotState.value
                    parkingLotData.value.content = comment.value
                    parkingLotData.value.open_time = parkingLotOpenTime.value
                    parkingLotData.value.close_time = parkingLotCloseTime.value

                    const data = parkingLotData.value
                    try {
                        await axios.patch('api/parkingLot/'+ data.parking_lot_id + '/update',data)
                        console.log(data)
                    }
                    catch (err) {
                        console.log(err)
                    }
                    parkingComments.value.push({
                        parking_lot_id: data.parking_lot_id,
                        content: comment.value
                    })
                    comment.value = null
                    editFormVisible.value = false
                }
            }

            const add = async() => {
                try {
                    await axios.post('api/parkingLot/add',createParam.value)
                    addFormVisible.value = false
                }
                catch (err) {
                    console.log(err);
                }
                console.log(createParam.value)
            }

            return {

                parkingLotDataList,
                state,
                route,
                getAllParkingLot,
                parkingComments,
                filteredComments,
                parkingSpaces,
                filteredParkingSpaces,
                editFormVisible,
                edit,
                parkingLotData,
                parkingLotState,
                parkingLotOpenTime,
                parkingLotCloseTime,
                update,
                comment,
                addFormVisible,
                add,
                createParam

            }
        },
        data() {
            return {
                tableState: 0,
                isReloadData: true
            }
        },
        beforeRouteEnter(to,from,next) {
            console.log(to,from)
            next((vm)=> {
                if(from.name == 'parkingLotEdit') {
                    vm.updateTable()
                    // vm.reloadPart()
                    console.log("From EDIT");
                }
            })
        },
        methods: {
            async updateTable() {
                this.parkingLotDataList.values = await this.getAllParkingLot()
                .then(()=> {
                    this.reload()

                })
                console.log(this.parkingLotDataList.values);
            },
            reloadPart() {
                this.isReloadData = false
                this.$nextTick(()=> {
                    this.isReloadData = true
                })
            }
        }
    }
</script>

<style scoped>
    a {
        margin: 4px;
    }

    @media screen and (max-width: 750px) {
        .el-message-box {
            width: 60% !important;
        }
    }

    .addButton {
        margin: auto;
    }
</style>
