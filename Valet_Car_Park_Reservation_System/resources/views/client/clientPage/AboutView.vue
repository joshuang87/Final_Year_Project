<template>
  <div class="data">
    <div class="carousel">
      <svg class="carousel-image" width="140" height="140">
        <!-- Replace circle and text with an image -->
        <image
          x="0"
          y="0"
          width="140"
          height="140"
          :xlink:href="carouselImages[activeIndex]"
        />
      </svg>
    </div>
  

  <div>
    <div class="container marketing">
      <div class="row">
        <div v-for="(member, index) in teamMembers" :key="index" class="col-lg-4">
          <svg
            class="bd-placeholder-img rounded-circle"
            width="140"
            height="140"
            xmlns="http://www.w3.org/2000/svg"
            role="img"
            aria-label="Placeholder: 140x140"
            preserveAspectRatio="xMidYMid slice"
            focusable="false"
          >
            <title>Us</title>
            <!-- Replace circle and text with an image -->
            <image
              x="0"
              y="0"
              width="140"
              height="140"
              :xlink:href="member.image"
            />
          </svg>
          <h2>{{ member.name }}</h2>
          <p>{{ member.role }}</p>
        </div>
      </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">Our Commision</h2>
            <p class="lead">Our mission is to create a convenient and comfortable parking experience for every driver in the city. Through innovative technology and user-friendly solutions, we are committed to eliminating parking challenges and making your parking process smoother and more enjoyable. Our goal is to save you time and energy, allowing you to focus on your day-to-day business without the hassle of parking. Whether you are a busy weekday commuter or a casual weekend driver, we are committed to providing efficient, safe and convenient parking solutions that create a hassle-free parking experience.</p>
          </div>
          <div class="col-md-5">
            <img style="width: 100%; height: 90%; object-fit: cover " src="images/commission.png">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">Our Story</h2>
            <p class="lead">TThe story starts with TAN Karma meeting NG, an editing genius known for hard work. They befriended CHONG, a tech expert. Despite being a "soy sauce" player in tech talks, TAN's humor and optimism brightened the team. TAN proposed a solution to a common problem: finding parking spaces. NG handled back-end development, CHONG designed the app. The team's effort birthed a smart parking system, showcasing their collaboration, innovation, and hard work.</p>
          </div>
          <div class="col-md-5 order-md-1">
            <img style="width: 100%; height: 80%; object-fit: cover" src="images/our.png" alt="">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">Our Location</h2>
            <p class="lead"></p>
          </div>
          <div class="col-md-5">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7976.789054662156!2d103.67153374062367!3d1.5307258438197593!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da73c109632e0b%3A0x74cda51bf210c304!2z5Y2X5pa55aSn5a2m5a2m6Zmi!5e0!3m2!1szh-CN!2smy!4v1692172763381!5m2!1szh-CN!2smy" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
        <hr class="featurette-divider">
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      carouselImages: [
        "images/car%20parking%20system.jpg",
        "images/OIP.jpeg",
        "images/Smart-Parking-System.jpg",
      ],
      activeIndex: 0,
      teamMembers: [
        {
          name: "Tan Jing Yuan",
          role: "Project manager",
          image: "images/Tan.png", // Path to Tan's image
        },
        {
          name: "Chong Shao Yi",
          role: "UI/UX front-end designer",
          image: "images/Chong.png", // Path to Chong's image
        },
        {
          name: "Joshua Ng Wei Qi",
          role: "Back-end Development",
          image: "images/Ng.png", // Path to Ng's image
        },
      ],
    };
  },
  mounted() {
    setInterval(() => {
      this.activeIndex = (this.activeIndex + 1) % this.carouselImages.length;
    }, 3000);
  },
};
</script>

<style scoped>

.data{
  background: linear-gradient(to bottom,transparent, #ffcccc,#ffcccc, #ffdd99,#ffdd99, #ffffcc,#ffffcc, #ccffcc,#ccffcc, #99ccff,#99ccff, #cc99ff,#cc99ff, transparent);
}
.carousel {
  position: relative;
  width: 100%;
  height: 100%;
  overflow: hidden;
}

.carousel-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.rounded-circle-image {
  width: 140px;
  height: 140px;
  border-radius: 50%;
  overflow: hidden;
  margin: auto;
}

.rounded-circle-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.text-left {
  text-align: left;
}
.text-right {
  text-align: right;
}
</style>

