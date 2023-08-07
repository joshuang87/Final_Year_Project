<template>

    <button @click="scrollToTop" class="btn btn-primary back-to-top zoom-effect" v-show="showButton">
      To Top
    </button>

</template>

  <script>
  export default {
    name: 'BackToTopButton',
    data() {
        return {
            showButton: false,
            scrollThreshold: 300,
      };
    },

    mounted() {
        window.addEventListener('scroll', this.handleScroll);
    },
    beforeUnmount() {
        window.removeEventListener('scroll', this.handleScroll);
    },
    methods: {
        handleScroll() {
            this.showButton = window.scrollY > this.scrollThreshold;
        },

        scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth',
            });
        },
    },

  };
  </script>

  <style>
  .back-to-top {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    display: none;
    z-index: 999;
  }
  </style>







