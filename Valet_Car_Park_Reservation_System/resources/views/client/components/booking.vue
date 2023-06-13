<template>




<div class="container-fluid">
    <div class="row">
            <div class="col-md-6">
                <br>
                <div class="container">
                    <div class="scrollable-table">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Parking Space ID</th>
                            <th>Parking Lot ID</th>
                            <th>Open Time</th>
                            <th>Close Time</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in items" :key="item.id">
                            <td>{{ item.parking_space_id }}</td>
                            <td>{{ item.parking_lot_id }}</td>
                            <td>{{ item.open_time }}</td>
                            <td>{{ item.close_time }}</td>
                            <td>{{ item.status }}</td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>

        <div class="col-md-6 border-start">
            <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                        <div class="card shadow">
                            <div class="card-body">
                                <h2 class="mb-4" style="text-align: center;">Book</h2>
                                <form class="form-container" @submit.prevent="submitBooking">
                                    <div class="form-group">
                                        <label class="form-label" for="carPlate">Car Plate:</label>
                                        <input class="form-control" type="text" id="carPlate" v-model="booking.carPlate" required>
                                    </div>
                                        <hr>
                                        <div class="form-group">
                                        <label class="form-label" for="phoneNumber">Phone Number:</label>
                                        <input class="form-control" type="tel" id="phoneNumber" v-model="booking.phoneNumber" required>
                                    </div>
                                        <hr>
                                        <div class="form-group">
                                        <label class="form-label" for="email">Email:</label>
                                        <input class="form-control" type="email" id="email" v-model="booking.email">
                                    </div>
                                        <hr>
                                        <div class="form-group">
                                        <label class="form-label" for="parkingSpaceId">Parking Space ID:</label>
                                        <input class="form-control" type="text" id="parkingSpaceId" v-model="booking.parkingSpaceId" required>
                                    </div>
                                        <hr>
                                        <div class="form-group">
                                        <label class="form-label" for="parkingLotId">Parking Lot ID:</label>
                                        <input class="form-control" type="text" id="parkingLotId" v-model="booking.parkingLotId" required>
                                    </div>
                                        <hr>
                                        <div class="form-group">
                                        <label class="form-label" for="date">Date:</label>
                                        <input class="form-control" type="date" id="date" v-model="booking.date" required>
                                    </div>
                                        <hr>
                                        <div class="form-group">
                                        <label class="form-label" for="time">Time:</label>
                                        <input class="form-control" type="time" id="time" v-model="booking.time" required>
                                    </div>
                                        <hr>
                                        <div class="form-group">
                                        <label class="form-label" for="duration">Duration (hours):</label>
                                        <input class="form-control" type="number" id="duration" v-model="booking.duration" required>
                                    </div>
                                        <hr>
                                    <button class="btn btn-primary" type="submit">Book Car Park</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><br>
  </template>

  <script>
  import axios from 'axios';
  import PaymentForm from 'V/components/PaymentForm.vue';

  export default {
    data() {
      return {
        items: [],
        booking: {
            carPlate: '',
            phoneNumber: '',
            email: '',
            parkingSpaceId: '',
            parkingLotId: '',
            date: '',
            time: '',
            duration: 0
        },
      };
    },

    components: {
      PaymentForm,
    },

    mounted() {
      this.fetchData();
    },

    methods: {
      fetchData() {
        axios.get('/api/parkingSpace/allData') // Replace '/api/items' with your Laravel API endpoint
          .then(response => {
            this.items = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      },
      submitBooking() {
        axios.post('/api/parkingSpace', this.booking)
            .then(response => {

            // Handle successful booking and proceed to payment
            })
            .catch(error => {
            // Handle booking error
            });
        }
    },
  };
  </script>

  <style>
    .scrollable-table {
        height: 1000px; /* Set the desired height */
        overflow-y: auto; /* Enable vertical scrolling */
    }
    .border-start {
        border-left: 1px solid #e9ecef; /* Adjust border color and thickness as needed */
        padding-left: 15px; /* Optional: Add padding for visual separation */
    }
  </style>
