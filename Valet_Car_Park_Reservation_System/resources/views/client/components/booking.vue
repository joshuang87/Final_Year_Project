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
                                            <label class="form-label" for="car_plate">Car Plate:</label>
                                            <input class="form-control" type="text" id="car_plate" v-model="booking.car_plate" required>
                                        </div>
                                        <hr/>    
                                        <div class="form-group">
                                            <label class="form-label" for="phone_number">Phone Number:</label>
                                            <input class="form-control" type="tel" id="phone_number" v-model="booking.phone_number" required>
                                        </div>
                                        <hr/>
                                        <div class="form-group">
                                            <label class="form-label" for="email">Email:</label>
                                            <input class="form-control" type="email" id="email" v-model="booking.email">
                                        </div>
                                        <hr/>
                                        <div class="form-group">
                                            <label class="form-label" for="parking_space_id">Parking Space ID:</label>
                                            <input class="form-control" type="text" id="parking_space_id" v-model="booking.parking_space_id" required>
                                        </div>
                                        <hr/>
                                        <div class="form-group">
                                            <label class="form-label" for="parking_lot_id">Parking Lot ID:</label>
                                            <input class="form-control" type="text" id="parking_lot_id" v-model="booking.parking_lot_id" required>
                                        </div>
                                        <hr/>
                                        <div class="form-group">
                                            <label class="form-label" for="date">Date:</label>
                                            <input class="form-control" type="date" id="date" v-model="booking.date" required>
                                        </div>
                                        <hr/>
                                        <div class="form-group">
                                            <label class="form-label" for="time">Time:</label>
                                            <input class="form-control" type="time" id="time" v-model="booking.time" required>
                                        </div>
                                        <hr/>
                                        <div class="form-group">
                                            <label class="form-label" for="duration">Duration (hours):</label>
                                            <input class="form-control" type="number" id="duration" v-model="booking.duration" required>
                                        </div>
                                        <hr/>
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
import { loadStripe } from '@stripe/stripe-js';
import PaymentForm from 'V/components/PaymentForm.vue';
// import { fetchAllParkingSpacesData } from 'V/api'

    export default {
        data() {
            return {
                items: [],
                booking: {
                    car_plate: '',
                    phone_number: '',
                    email: '',
                    parking_space_id: '',
                    parking_lot_id: '',
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
                axios.get('/api/parkingSpace/allData')
                    .then(response => {
                        this.items = response.data;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            async redirectToStripe() {
                // Make an API request to your Laravel backend
                const response = await axios.post('api/reserve/payment',this.booking);
                const sessionId = response.data.sessionId;
                // Redirect the user to the Stripe checkout page
                const stripe = Stripe('pk_test_51MHkNwAAIANGTO9uk5MsvOteodjvYlAIBwMZRaTj71eMAtWISNGHrJD5UCzc2a7BAbQxn3QdUB6N8uvyvuriFCuP00ASOZdJWw');
                const { error } = await stripe.redirectToCheckout({sessionId});

                if (error) {
                    // Handle any errors during redirection
                    console.error(error);
                }
            },
            async startCheckout() {
                const stripe = await loadStripe('pk_test_51NGxNDGmA7QKNFMQAHGPm8IVsFAp2dqD7P5tvURFQCz3iDIAu0kWnOJgZ2mpVGSatoJxAKQRguqFqWC9FxYWOno800PHJXypYc');

                const { error } = await stripe.redirectToCheckout(
                    {
                        lineItems: [
                            {
                                price: 'price_1NHVB6GmA7QKNFMQJNx8Wpe0',
                                quantity: 1
                            } // Replace with your Stripe price ID
                        ],
                        mode: 'payment',
                        successUrl: 'http://127.0.0.1:8000/client#/', // Redirect URL after successful payment
                        cancelUrl: 'http://127.0.0.1:8000/client#/bookTest' // Redirect URL if the payment is canceled
                    }
                );

                if (error) {
                    console.error('Error:', error);
                }
            },
            submitBooking() {
                this.redirectToStripe();
                // this.startCheckout();
                // axios.post('/api/reserve', this.booking)
                //     .then(response => {
                //         console.log(response)
                //     // Handle successful booking and proceed to payment
                //         // this.storePayment(response.reserve_id)
                //     })
                //     .catch(error => {
                //     // Handle booking error
                //     console.log(error);
                //     });

            },
            storePayment() {
                axios.post('/api/reserve/payment/store',[
                    'dadad',
                    '34'
                ])
                .then(response => {
                    console.log(response)
                })
                .catch(error => {
                    console.log(error)
                })
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
