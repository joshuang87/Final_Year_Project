<template>
<div><space/></div>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <Suspense>
      <booking />
    </Suspense>

</template>

<script setup>
import booking from 'V/components/booking.vue';
import space from 'V/components/space.vue';

  </script>

<style>
/* add some style  */
</style>
