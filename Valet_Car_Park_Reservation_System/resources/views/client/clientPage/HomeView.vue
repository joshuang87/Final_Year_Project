
<template>

    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>

<home />


</template>


<script>
import home from 'V/components/home.vue';

  export default{
    components: {
      home,
  },
  }

</script>

<style>
@media (min-width: 1024px) {
        .home {
        margin:150px;
        }
    }
    .titleBox{
        margin-left: 150px;
        margin-right: 150px;
        margin-top: 40px;
        margin-bottom: 40px;
    }

</style>
