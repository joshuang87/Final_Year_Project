<template>
   <div style="background: linear-gradient(to bottom, transparent,  #ffcccc, #ffcccc, #ffbbdd,#ffbbdd,#eebbff)"><home /></div>

<div class="scroll-container">
<!-- 添加滚动渐变效果的内容 -->
<!-- <section :class="['scroll-transition', { active: scrolled }]">内容</section> -->

<!-- 添加滚动渐变效果的左图右字内容 -->
 <section :class="['scroll-transition', { active: scrolled }]" style="background: linear-gradient(to bottom, #eebbff,#ccbbff)"> 
  <div class="container"> 
    <div class="row"> 
      <!-- 左边图片 --> 
      <div class="col-md-6"> 
        <img src="images/Intro1.png" alt="Image" class="w-100" /> 
      </div> <!-- 右边介绍 --> 
      <br><br>
      <div class="col-md-6"> 
        <h2>Valet Parking  Reservation System</h2> 
        <p>Say goodbye to the hassle of finding parking with our 
        valet car park reserve system!Our online reservation
          system allows you to reserve a parking space in
          advance,saving you time and stress.With just a few
          clicks,you can book your spot,guaranteeing that you'll
          have a parking space when you arrive.
          Our system is designed to make the booking process as
          simple as possible.You can easily select the date and
          total time of parking,make payments online,and receive
          an invoice via SMS.If your plans change,you can also
          cancel your reservation hassle-free.
          Once you've made your payment,our system generates
          a QR code,which is scanned by our staff when you
          arrive.This guarantees a smooth and efficient parking
          experience,without the need to search for a parking
          spot </p> 
      </div> 
    </div> 
  </div> 
</section>

<!-- 分割行 --> 
<!-- 添加滚动渐变效果的右图左字内容 --> 
<section :class="['scroll-transition', { active: scrolled }]" style="background: linear-gradient(to bottom, #ccbbff,#aaccff,#aaccff)"> 
  <div class="container"> 
    <div class="row"> 
    <!-- 左边介绍 --> 
    <div class="col-md-6"> 
      <h2>Payment Sytem </h2> 
      <p> Our payment system has been upgraded to make your
        parking experience even more convenient!We now
        accept various cashless payment methods,including
        credit cards,debit cards,mobile payments,and e-
        wallets.With this,you no longer have to worry about not
        having cash or not having exact change.
        Now,you can easily complete your payment using your
        phone or other electronic devices.You don't have to
        worry about complicated payment processes as our
        payment system will guide you through the steps.Our
        system is secure and reliable,and your personal and
        payment information will be protected.
        Our cashless payment methods not only make your
        parking experience more convenient and worry-free,but
        also help you better manage your parking expenses.You
        can check your parking and payment records anytimeand anywhere,avoiding any missed payments. </p> 
    </div> 
    <!-- 右边图片 --> 
    <div class="col-md-6"> 
      <img src="images/Intro2.png" alt="Image" class="w-100" /> 
    </div> 
  </div> 
</div> 
</section> 

<section :class="['scroll-transition', { active: scrolled }]" style="background: linear-gradient(to bottom,#aaccff, #99ddff)"> 
  <div class="container"> 
    <div class="row"> 
      <!-- 左边图片 --> 
      <div class="col-md-6"> 
        <img src="images/Intro3.png" alt="Image" class="w-100" /> 
      </div> <!-- 右边介绍 --> 
      <div class="col-md-6"> 
        <h2>Availability Check </h2> 
        <p style="" > Now you can check the availability of parking spots before arriving at the car park!Our parking system
          provides real-time information on available parking
          spots,allowing you to plan ahead and ensure that there's
          a spot for you.
          There are many benefits to this feature.Firstly,you can
          avoid the frustration of arriving at a busy car park only to
          find that all the spots are taken,wasting your time and
          energy.Secondly,you can plan your schedule more
          easily since you'll know in advance whether there's a
          parking spot available and can plan accordingly.
          With our parking system,you can easily select the
          parking date and total duration to best suit your needs.
          We also offer a range of other services such as valet
          parking,car washing,tinting and waxing to make your
          parking experience more enjoyable and hassle-free. </p> 
      </div> 
    </div> 
  </div> 
</section>

<section :class="['scroll-transition', { active: scrolled }]" style="background: linear-gradient(to bottom, #99ddff, #99ffff,#99ffff,transparent)"> 
  <div class="container"> 
    <div class="row"> 
    <!-- 左边介绍 --> 
    <div class="col-md-6"> 
      <h2>Cancellation System </h2> 
      <p> Our car park reservation system allows you to reserve
        a
        parking spot anytime,anywhere with ease.And if you
        need to cancel a reservation,our system provides a
        simple and convenient way to do so.Enjoy a hassle-free
        parking experience with us now!We understand that
        plans can change,and you may need to cancel or delete
        your reservation.Therefore,our reservation system
        provides a simple way to delete a reservation. </p> 
    </div> 
    <!-- 右边图片 --> 
    <div class="col-md-6"> 
      <img src="images/Intro4.png" alt="Image" class="w-100" /> 
    </div> 
  </div> 
</div> 
</section> 
</div>
  </template>


<script>
import home from 'V/components/home.vue';

  export default{
    components: {
      home,
  },
  data() {
    return {
      activeIndex: 0,
      scrolled: false,
      scrolledSections:[],
    };
  },
  mounted() {
    window.addEventListener('scroll', this.handleScroll);
},
beforeDestroy() {
    window.removeEventListener('scroll', this.handleScroll);
},
  methods: {
    nextImage() {
      this.activeIndex = (this.activeIndex + 1) % this.carouselImages.length;
    },
    prevImage() {
      this.activeIndex =
        (this.activeIndex - 1 + this.carouselImages.length) %
        this.carouselImages.length;
    },
    handleScroll() {
      const scrollY = window.scrollY;
      const transitionStart = 450;

      if (scrollY >= transitionStart && !this.scrolled) {
        this.scrolled = true;
      } else if (scrollY < transitionStart && this.scrolled) {
        this.scrolled = false;
      }
    },
  },
  created() {
    setInterval(this.nextImage, 5000);
    window.addEventListener('scroll', this.handleScroll);
  },
  beforeDestroy() {
    window.removeEventListener('scroll', this.handleScroll);
  },
};
</script>

<style>
@media (min-width: 1024px) {
        .home {
        margin:50px;
        }
    }
    .titleBox{
        margin-left: 150px;
        margin-right: 150px;
        margin-top: 40px;
        margin-bottom: 40px;
        background-color: #99ccff;
    }

    .centered-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
}

.large-font {
  font-size: 35px; /* You can adjust the font size as needed */
  
}

    .carousel {
  position: relative;
}

.carousel-inner {
  position: relative;
  width: 100%;
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

.carousel-item {
  flex-shrink: 0;
  opacity: 0;
  transition: opacity 1s ease-in-out;
}

.carousel-item.active {
  opacity: 1;
  transition: opacity 1s ease-in-out;
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

.scroll-container {
  position: relative;
  width: 100%;
  top: 0;
  left: 0;
  z-index: -1;
}

.page-transition.active {
  opacity: 1;
  transform: translateY(0);
}

@keyframes fadeInUp {
  0% {
    opacity: 0;
    transform: translateY(20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

</style>
