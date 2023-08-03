<template>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <br>
                    <div class="container">
                        <div class="scrollable-table">
                            <div class="row">
                            <!-- Use nested v-for to create the grid layout -->
                                <div v-for="row in itemsAs2DArray" :key="`row-${row[0].parking_lot_id}`" class="col-md-6">
                                    <div v-for="item in row" :key="item.parking_space_id" class="mb-3">
                                    <!-- Use a button to display parking space ID -->
                                    <button class="btn btn-primary" @click="onSpaceButtonClick(item)">
                                        {{ item.parking_space_id }}
                                    </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="col-md-6 border-start">
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h2 class="mb-4" style="text-align: center;">Cart</h2>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Parking Space ID</th>
                                            <th>Parking Lot ID</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="cartItem in cart" :key="cartItem.parking_space_id">
                                            <td>{{ cartItem.parking_space_id }}</td>
                                            <td>{{ cartItem.parking_lot_id }}</td>
                                            <td>
                                            <button class="btn btn-danger" @click="removeFromCart(cartItem)">
                                                Delete
                                            </button>
                                            </td>
                                        </tr>
                                        <br>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookingModal">
                                                Confirm
                                            </button>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br>

    <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="bookingtModalLabel">Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="container">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="card-body">
                                    <h2 class="mb-4" style="text-align: center;">Book</h2>
                                    <form class="form-container" @submit.prevent="submitBooking">
                                        <div class="form-group">
                                            <label class="form-label" for="car_plate">Car Plate:</label>
                                            <input class="form-control" type="text" id="car_plate">
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label class="form-label" for="phone_number">Phone Number:</label>
                                            <input class="form-control" type="tel" id="phone_number">
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label class="form-label" for="email">Email:</label>
                                            <input class="form-control" type="email" id="email">
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Parking Space ID</th>
                                            <th scope="col">Parking Lot ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="cartItem in cart" :key="cartItem.parking_space_id">
                                            <td>{{ cartItem.parking_space_id }}</td>
                                            <td>{{ cartItem.parking_lot_id }}</td>
                                        </tr>
                                        <tr>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                        Pay with Debit/Credit Card (Stripe)
                    </button>
                    <button type="button" class="btn btn-primary">Pay with TNG</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

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
                cart: [],
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

        computed: {
            // Convert the 'items' array to a 2D array for grid layout
            itemsAs2DArray() {

                const colsPerRow = 2; // Set the number of columns per row
                const result = [];
                let tempRow = [];

                this.items.forEach((item, index) => {
                    tempRow.push(item);
                    if ((index + 1) % colsPerRow === 0 || index === this.items.length - 1) {
                        result.push(tempRow);
                        tempRow = [];
                    }
                });

                return result;
            },
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

            onSpaceButtonClick(item) {
                // Handle the button click event, you can access the item's data here
                this.booking.parking_space_id = item.parking_space_id;
                this.booking.parking_lot_id = item.parking_lot_id;
                this.cart.push({
                    parking_space_id: item.parking_space_id,
                    parking_lot_id: item.parking_lot_id,
                });
                // Set other relevant data from 'item' to 'this.booking' as needed
                // You can then use this data to pre-fill the form or take other actions
            },

            removeFromCart(cartItem) {
                // Remove the selected item from the cart
                const index = this.cart.indexOf(cartItem);
                if (index !== -1) {
                    this.cart.splice(index, 1);
                }
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
                        cancelUrl: 'http://127.0.0.1:8000/client#/booking' // Redirect URL if the payment is canceled
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
