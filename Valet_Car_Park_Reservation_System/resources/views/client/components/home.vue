<template>

    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>

<br><br><br><br><br><br><br><br><br><br>

    <div class="container zoom-effect">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card shadow">
                    <div class="card-body text-center col mt-5 mb-5">
                        <h1 class="">Welcome to Our Website</h1>
                        <p class="lead">Easy & Fast Reservation a parking space.</p>
                        <RouterLink to="/booking"><button class="btn btn-outline-primary zoom-effect">Start Booking !</button></RouterLink>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <br><br><br><br><br><br><br><br><br><br>


</template>


<script>

  export default{
    data(){
      return{
        homeSizeClass:'home'
      }
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
