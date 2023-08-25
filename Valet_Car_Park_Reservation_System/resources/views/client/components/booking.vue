<template>
    <div class="d-flex justify-content-center mt-3 border-bottom container">
        <h2>Reservation</h2>
    </div>
    <div class="centered-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-3">
                  <label for="parkingLotSelect" class="form-label">Parking Lot ID</label>
                  <select v-model="bookingParam.parking_lot_id" class="form-select" id="parkingLotSelect">
                      <!-- Populate with parking lot IDs -->
                      <option v-for="parkingLot in parkingLots" :value="parkingLot.parking_lot_id" :key="parkingLot.parking_lot_id">{{ parkingLot.parking_lot_id }}</option>
                  </select>
              </div>
              <div class="col-md-3 mb-3">
                  <label for="dateInput" class="form-label">Date</label>
                  <input v-model="bookingParam.date" type="date" class="form-control" id="dateInput">
              </div>
              <div class="col-md-3 mb-3">
                  <label for="startTimeInput" class="form-label">Start Time: </label>
                  <div>
                      <el-time-select
                          v-model="bookingParam.start_time"
                          :max-time="bookingParam.end_time"
                          class="mr-4"
                          placeholder="Start time"
                          start="08:00"
                          step="01:00"
                          end="17:00"
                      />
                  </div>
              </div>
              <div class="col-md-3 mb-3">
                  <label for="endTimeInput" class="form-label">End Time  :</label>
                  <div>
                      <el-time-select
                          v-model="bookingParam.end_time"
                          :min-time="bookingParam.start_time"
                          placeholder="End time"
                          start="09:00"
                          step="01:00"
                          end="17:00"
                      />
                  </div>
              </div>
            </div>
        </div>

        <!-- Similar dropdowns for Date, Start Time, and End Time -->

        <div class="d-flex justify-content-center">
            <button @click="filter" class="btn btn-primary" :disabled="!bookingParam.date || !bookingParam.start_time || !bookingParam.end_time">
                Filter
            </button>
        </div>

        <div class="d-flex justify-content-center mt-3 border-bottom">
            <h2>Available Parking Space</h2>
        </div>

        <grid-layout :layout.sync="layout"
                     :col-num="12"
                     :row-height="80"
                     :is-draggable="false"
                     :is-resizable="false"
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
                <button @click="book(item.i)">
                    {{ item.parking_space_id }}
                </button>
            </grid-item>
        </grid-layout>

        <el-dialog
            v-model="bookingForm"
            title="Booking Form"
            align-center
            draggable
        >
            <el-form>
                <el-form-item label="Car Plate : ">
                    <el-input clearable v-model="bookingParam.car_plate"/>
                </el-form-item>
                <el-form-item label="Email : ">
                    <el-input clearable v-model="bookingParam.email"/>
                </el-form-item>
            </el-form>
            <template #footer>
                <span class="dialog-footer">
                    <el-button @click="bookingForm = false">
                        Cancel
                    </el-button>
                    <el-button type="primary" @click="reserve">
                        Conform
                    </el-button>
                </span>
            </template>
        </el-dialog>

        <!-- <div class="d-flex justify-content-center mt-3">

            <button
              v-for="space in groupedFilteredSpaces"
              :key="space.parking_space_id"
              :class="['btn', 'btn-success', 'm-1', { 'btn-primary': space.parking_space_id === selectedSpaceId }]"
              @click="selectSpace(space.parking_space_id)"
            >
                {{ space.parking_space_id }}
            </button>
        </div> -->

        <div class="d-flex justify-content-center mt-3" style="margin-top: 20px;" v-if="selectedSpaceId">
            <div class="card-body card shadow">
                <form v-if="selectedSpaceId" @submit.prevent="bookParkingSpace">
                    <div class="mb-3">
                        <label for="carPlateInput" class="form-label">Car Plate Number</label>
                        <input v-model="carPlate" type="text" class="form-control" id="carPlateInput" required>
                    </div>
                    <div class="mb-3">
                        <label for="emailInput" class="form-label">Email</label>
                        <input v-model="email" type="email" class="form-control" id="emailInput" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref,watchEffect } from 'vue'
    import axios from 'axios';

    const parkingLots = ref(null)
    const bookingForm = ref(false)
    const parkingSpace = ref(null)

    const bookingParam = ref(
        {
           date: null,
           start_time: null,
           end_time: null,
           status: false,
           email: null,
           car_plate: null,
           parking_lot_id: null,
           parking_space_id: null 
        }
    )

    const getAllParkingLots = async() => {
        try {
            const response = await axios.get('api/parkingLot/allId')
            const data = response.data

            return data
        }
        catch(err) {
            console.log(err);
        }
    }

    parkingLots.value = await getAllParkingLots()


    const layout = ref(null)

    // watchEffect(async() => {

    //     let parkingLotId = bookingParam.value.parking_lot_id

    //     const getAllParkingSpacesData = async() => {
    //         try {
    //             const response = await axios.get('api/parkingSpace/filter/' + parkingLotId)
    //             const data = response.data

    //             return data
    //         }
    //         catch(error) {
    //             console.log(error)
    //         }
    //     }

    //     const parkingSpaces = await getAllParkingSpacesData()
    //     const specificParkingSpaceData = parkingSpaces.filter(item => item.parking_lot_id === parkingLotId)

    //     layout.value = specificParkingSpaceData
    //     console.log(specificParkingSpaceData)

    // })

    const filter = async() => {
        try {
            const response = await axios.post('api/checkAvailability',bookingParam.value)

            console.log(response.data[0]);
            if(response.data == true) {
                    let parkingLotId = bookingParam.value.parking_lot_id

                    const getAllParkingSpacesData = async() => {
                        try {
                            //  ALL PARKING SPACES DATA 
                            const response = await axios.get('api/parkingSpace/filter/G0')
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

            }
            else if(response.data[0] = 'false') {
                let parkingLotId = bookingParam.value.parking_lot_id

                    const getAllParkingSpacesData = async() => {
                        try {
                            //  ALL PARKING SPACES DATA 
                            const response = await axios.get('api/parkingSpace/filter/G0')
                            const data = response.data

                            return data
                        }
                        catch(error) {
                            console.log(error)
                        }
                    }

                    const parkingSpaces = await getAllParkingSpacesData()
                    const specificParkingSpaceData = parkingSpaces.filter(item => item.parking_lot_id === parkingLotId)
                    // const filterData = specificParkingSpaceData.filter(item => item.parking_space_id !== response.data[1][0])
                    console.log(response.data[1]);
                    const filterData = specificParkingSpaceData.filter(item => {
                        // 使用 some 方法检查是否有任何一个元素匹配
                        return !response.data[1].some(dataItem => dataItem === item.parking_space_id);
                        });


                    layout.value = filterData
                    console.log(filterData)
                // console.log(response.data[1][0]);
            }
            else {
                console.log('SOME ERROR');
            }
        }
        catch(err) {
            console.log(err);
        }
    }

    const book = async(val) => {
        const index = layout.value.map(item => item.i).indexOf(val)
        parkingSpace.value = layout.value[index]
        bookingParam.value.parking_space_id = layout.value[index].parking_space_id
        bookingForm.value = true
        console.log(bookingParam.value);
    }

    const reserve = async() => {
        try {
            await axios.post('api/booking',bookingParam.value)
        }
        catch(err) {
            console.log(err);
        }
        bookingForm.value = false
    }

</script>

<style>

    .centered-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 50vh;
    }

</style>
