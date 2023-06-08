<template>
    <head>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
  

  
  
<!--
    <h1 :class="fontClass" :id='fontId'>{{ msg }}</h1>
    <h1 v-bind='fontClassId'>{{ msg }}</h1>
    <h1 v-if="flag">can you see me</h1>
    <h1>{{ msg.split('').reverse('').join('') }}</h1>
    <h1>{{ number +1}}</h1>
    <h1>{{ ok ? 'yes' : 'No' }}</h1>
    <p v-html="rawHtml"></p>
    <button class="btn btn-danger" :disabled="disableBtn">{{ msg }}</button>
    <h2 v-for="item in cars">{{ item }}</h2>
    <ul>
      <li v-for="item of cars">{{ item }}</li>
    </ul>
    <input type="text" v-model="userInput">
    <p>{{ userInput }}</p><br>
    <input type="text" v-model="userPassword">
    <p>{{ userPassword }}</p>
    <div>
      <h2>table store</h2>
      <table>
        <thead>
          <tr>
            <tr>table</tr>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in data" :key="'item.id'">
          <td>{{ item.name }}</td>
          <td>{{ item.time }}</td>
          <td>{{ item.price }}</td>
        </tr>
        </tbody>
      </table>
    </div>-->
    <br>
    <div>
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
  

      

  </template>
  
  <script>
  export default{
    /*data(){
      return{
        //v-bind
        msg:'Hello world',
        number: 10,
        ok:false,
        rawHtml:"<a href= 'https://www.youtube.com/'>Youtube</a>",

        //v-bind
        fontClass:'makeRed',
        fontId:'msgId',
        disableBtn:false,
        //or
        fontClassId:{
          Class:'makeRed',
          Id:'msgId2',
          Title:'v-bindExample',
        },
        flag:true,

        //v-for
        cars:['volvo','toyota','lexus'],

        //v-model
        userInput:"",
        userPassword:"",
      }
    }*/
    computed: {
    data() {
      return this.$store.state.data; // Access data from Vuex store
    },
  },
  }
  </script>

  <style>
    .makeRed{
      color:red;
    }
  </style>