<template>
    <head>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>



    <br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="card shadow">
            <div class="card-body">
                <form class="form-container" @submit="submitForm">
                        <div class="form-group">
                            <label for="parkingSpace">Select Parking Space:</label>
                            <select v-model="selectedParkingSpace" class="form-control" id="parkingSpace">
                                <option v-for="space in parkingSpaces" :key="space.id" :value="space.id">{{ space.name }}</option>
                            </select>
                            </div>
                            <div class="form-group">
                            <label for="dateTime">Select Date and Time:</label>
                            <input v-model="selectedDateTime" type="datetime-local" class="form-control" id="dateTime">
                            </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Book Parking</button>
                        </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card shadow">
            <div class="card-body text-center col mt-5 mb-5">
              <div class="titleBox">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookingModal" >
                          Confirm
                </button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookingModal" @click="cancelData">
                          Cancel
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--modal-->

          <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="bookingtModalLabel">Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                  </div>
                    <div class="modal-body">
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
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <RouterLink to="/payment">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="navigateToPageB">
                          Make Payment
                        </button>
                    </RouterLink>
                    </div>
              </div>
            </div>
          </div>
          <br><br><br><br><br><br><br><br><br><br><br><br>

  </template>

  <script>
  export default{
    data(){

    },
    methods:{
      navigateToPageB() {
      this.$store.dispatch('setData', [
        { id: 1, date: '1/1/2023', time: '10:00am - 11:00am', price: 'RM20.00' },
        { id: 2, date: '1/1/2023', time: '10:00am - 11:00am', price: 'RM20.00' },
        { id: 3, date: '1/1/2023', time: '10:00am - 11:00am', price: 'RM20.00' },
        { id: 4, date: '1/1/2023', time: '10:00am - 11:00am', price: 'RM20.00' },
        // Add more data as needed
      ]);
      //this.$router.push('/tutorial');
    },
    cancelData(){
      this.$store.dispatch('setData', null);
    }
  },
  computed: {
    data() {
      return this.$store.state.data; // Access data from Vuex store
    },
  },
  beforeRouteEnter(to,from,next){
    console.log(to,from)
    next(console.log("end"))
  }
  }
  </script>

<style>
  .home {
    margin:150px;
  }
  .titleBox{
    margin-left: 150px;
    margin-right: 150px;
    margin-top: 40px;
    margin-bottom: 40px;
  }
</style>
