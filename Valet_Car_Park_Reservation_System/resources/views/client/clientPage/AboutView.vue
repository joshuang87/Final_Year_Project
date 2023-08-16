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
          <h2 style="color:darkblue">{{ member.name }}</h2>
          <p>{{ member.role }}</p>
        </div>
      </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It’ll blow your mind.</span></h2>
            <p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting prose here.</p>
          </div>
          <div class="col-md-5">
            <!-- Add your image or any content here -->
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">Oh yeah, it’s that good. <span class="text-muted">See for yourself.</span></h2>
            <p class="lead">Another featurette? Of course. More placeholder content here to give you an idea of how this layout would work with some actual real-world content in place.</p>
          </div>
          <div class="col-md-5 order-md-1">
            <!-- Add your image or any content here -->
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
            <p class="lead">And yes, this is the last block of representative placeholder content. Again, not really intended to be actually read, simply here to give you a better view of what this would look like with some actual content. Your content.</p>
          </div>
          <div class="col-md-5">
            <!-- Add your image or any content here -->
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

