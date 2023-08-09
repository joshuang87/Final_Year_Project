<template>
  <div class="about">
    <h1>This is an about page</h1>
  <el-carousel :interval="4000" type="card" height="200px">
    <el-carousel-item v-for="item in 6" :key="item">
      <h3 text="2xl" justify="center">{{ item }}</h3>
    </el-carousel-item>
  </el-carousel>

  <h2>Valet Car Park Reservation System</h2>
  <div class="images">
    <img v-for="(image, index) in images" :key="index" :src="image" />
  </div>  
</div>
</template>

<script>
export default {
  data(){
    return {
      images:[
        "../../../picture/car parking system.jpg",
        "../../../picture/OIP.jpeg",
        "../../../picture/Smart-Parking-System.jpg",
      ]
    }
  }
}
</script>

<style scoped>
.el-carousel__item h3 {
  color: #475669;
  opacity: 0.75;
  line-height: 200px;
  margin: 0;
  text-align: center;
}

.el-carousel__item:nth-child(2n) {
  background-color: #99a9bf;
}

.el-carousel__item:nth-child(2n + 1) {
  background-color: #d3dce6;
}
</style>

  <style>
  @media (min-width: 1024px) {
    .about {
      margin-left: 37%;
      min-height: 100vh;
      display: flex;
      align-items: center;
      text-align: center;
    }
    .btn{
      align-items: center;
    }
  }
  </style>
