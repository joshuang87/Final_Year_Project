<template>
    <head>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
  <!--
    <div class="container-fluid">
              <div class="row">
                  <div class="col-md-12">
                      <div class="B-area">
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          Confirm
                          </button>
                      </div>
                  </div>
              </div>
          </div>-->
  
  <div class="container">
    <div class="card shadow">
      <div class="card-body" style="margin:30px">
        <div class="container">
            <div class="d-flex justify-content-center">
              <h1>Payment</h1>
            </div>
        </div>
        
        <hr>
                    <form class="form-container">
                        <h3>Customer Information</h3>
                        <div class="form-group">
                            <label for="Phone">Phone Number</label>
                            <input type="Phone" class="form-control" id="Phone" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="CarPlate">Car Plate</label>
                            <input type="CarPlate" class="form-control" id="CarPlate" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="Email">Email (Optional)</label>
                            <input type="Email" class="form-control" id="Email" placeholder="">
                        </div>
                    </form>
                    <br>
                    <hr>
                    <br>
                    <h3>Payment Details</h3>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Parking Space ID</th>
                                <th scope="col">Reservation Date</th>
                                <th scope="col">Reservation Time Slot</th>
                                <th scope="col">Price (MYR)</th>
                            </tr>
                            </thead>
                            <tbody>
                              <tr v-for="item in data" :key="'item.id'">
                                <td>{{ item.id }}</td>
                                <td>{{ item.date }}</td>
                                <td>{{ item.time }}</td>
                                <td>{{ item.price }}</td>
                              </tr>
                              <tr>
                                  <td colspan="3">Total Amount</td>
                              </tr>
                            </tbody>
                        </table>
                        <br>
                        <hr>
                        <div class="container">
                          <div class="d-flex justify-content-center">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal">Make Payment</button>
                          </div>
                        </div>                
      </div>
    </div>

    <!--modal-->

        <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="paymentModalLabel">Payment</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                  <div class="modal-body">
                    <form @submit.prevent="submitForm">
                      
                      <div class="mb-3">
                        <label for="cardNumber" class="form-label">Card Number 
                          <i class="fab fa-cc-visa" style="margin-right: 1px;"></i>
                          <i class="fab fa-cc-mastercard"></i>
                        </label>
                        <input type="text" class="form-control" id="cardNumber" v-model="cardNumber" />
                      </div>

                      <div class="row mb-3">
                        <div class="col-md-6">
                          <label for="expirationDate" class="form-label">Expiration Date</label>
                          <input type="text" class="form-control" id="expirationDate" v-model="expirationDate" />
                        </div>
                        
                        <div class="col-md-6">
                          <label for="cvv" class="form-label">CVV <i class="fas fa-question-circle"></i></label>
                          <input type="text" class="form-control" id="cvv" v-model="cvv" />
                        </div>
                      </div>

                      <div class="mb-3">
                        <label for="cardHolderName" class="form-label">Cardholder Name</label>
                        <input type="text" class="form-control" id="cardHolderName" v-model="cardHolderName" />
                      </div>

                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Make Payment</button>
                  </div>
              </div>
            </div>
          </div>

    </div>
      

  </template>
  
  <script>
export default {
  data() {
    return {
      cardNumber: '',
      expirationDate: '',
      cvv: '',
      cardHolderName: '',
    };
  },
  methods: {
    submitForm() {
      // Validate and process the payment form
      // You can perform any additional logic or make API requests here
      // Access the form data using this.cardNumber, this.expirationDate, this.cvv, this.cardHolderName
      console.log('Payment form submitted');
    },
  },
  computed: {
    data() {
      return this.$store.state.data; // Access data from Vuex store
    },
  },
};
  </script>

<style>
@media (min-width: 1024px) {
  .home {
    margin-left: 38%;
    min-height: 100vh;
    display: flex;
    align-items: center;
    text-align: center;
  }
  .btn{
    align-items: center;
  }
}
</style>