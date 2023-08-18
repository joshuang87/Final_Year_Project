<template>
    <div>
        <div>
            <h1>Parking Lot data</h1>
        </div>
    
        <div>
            <el-table :data="parkingLotDataList" border fit >
                <el-table-column type="expand">
                    <template #default="props">
                        <el-row>
                            <el-col :span="12">
                                <div>
                                    <h3>Available Parking Spaces</h3>
                                    <el-table :data="filteredParkingSpaces(props.row.parking_lot_id)">
                                        <el-table-column prop="parking_space_id" label="Parking Spaces ID" />
                                    </el-table>
                                </div>
                            </el-col>
                            <el-col :span="12">
                                    <div>
                                        <h3>Comments History</h3>
                                        <el-table :data="filteredComments(props.row.parking_lot_id)">
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
                    <template #default>
                        <el-button text type="primary" @click="dialogFormVisible = true" icon="Edit">Edit</el-button>
                        <el-button text type="danger" icon="Delete" >Delete</el-button>
                    </template>
                  </el-table-column>
            </el-table>
        </div>
        
        <el-dialog 
            v-model="dialogFormVisible"
            title="Parking Lot Information Edit"
            align-center
            draggable
        >
            <el-form>
                <el-form-item label="Parking Lot ID : ">
                    <el-input clearable v-model="parkingLotDataList.parking_lot_id"/>
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
                    <el-button @click="dialogFormVisible = false">Cancel</el-button>
                    <el-button type="primary" @click="dialogFormVisible = false">Update</el-button>
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
            const dialogFormVisible = ref(false)

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
                    }
                    catch(error) {
                        console.log(error);
                    }
                }
            })

            const filteredComments = computed(()=> (props)=> {
                return parkingComments.value.filter(comment => comment.parking_lot_id == props)
            })

            const filteredParkingSpaces = computed(()=> (props)=> {
                return parkingSpaces.value.filter(parkingSpace => parkingSpace.parking_lot_id == props)
            })

            return {
                parkingLotDataList,
                state,
                route,
                getAllParkingLot,
                parkingComments,
                filteredComments,
                parkingSpaces,
                filteredParkingSpaces,
                dialogFormVisible
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
                    // this.reload()
                    
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
</style>