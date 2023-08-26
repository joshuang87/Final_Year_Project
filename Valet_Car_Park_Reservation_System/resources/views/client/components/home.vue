<template>

    <head >
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>

<br><br><br><br><br><br><br><br><br><br>

    <div class="container zoom-effect">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="">
                    <div class="card-body text-center col mt-5 mb-5">
                        <h1 class="">Welcome to Our Website</h1>
                        <p class="lead">Easy & Fast Reservation a parking space.</p>
                        <RouterLink to="/booking"><button class="btn btn-outline-primary zoom-effect">Start Booking !</button></RouterLink>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <section :class="['scroll-transition', { active: scrolled }]"><about/></section>

</template>


<script>
  export default{
    data(){
      return{
        scrolled: false,
      }
    },

    mounted() {
      window.addEventListener('scroll', this.handleScroll);
    },
    beforeDestroy() {
      window.removeEventListener('scroll', this.handleScroll);
    },

    methods: {
      handleScroll() {
        const scrollY = window.scrollY;
        const transitionStart = 100;

        if (scrollY >= transitionStart && !this.scrolled) {
          this.scrolled = true;
        }
        else if (scrollY < transitionStart && this.scrolled) {
          this.scrolled = false;
        }
      },
    },

  }

</script>

<style>

  .centered-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
  }

  .scroll-transition {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 3s ease, transform 3s ease;
  }

  .scroll-transition.active {
    opacity: 1;
    transform: translateY(0);
  }

</style>
