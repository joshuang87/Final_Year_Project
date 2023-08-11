<template>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

          <Header />

          <RouterView />

          <BackToTopButton />

          <Footer />
  </template>

  <script>
  import BackToTopButton from 'V/components/BackToTopButton.vue';
  import Header from 'V/components/Header.vue';
  import Footer from 'V/components/Footer.vue';


  export default{
    components: {
        BackToTopButton,
        Header,
        Footer,
    },
  }

  </script>

  <style>

    .zoom-effect {
        text-decoration: none;
        transition: transform 0.6s ease;
    }

    .zoom-effect:hover {
        transform: scale(1.1);
    }

  </style>
