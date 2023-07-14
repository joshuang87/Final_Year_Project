<template>
  <div class="about">
    <div ref="canvasContainer" class="three-scene"></div>
  </div>
</template>

<script>
import * as THREE from 'three';

export default {
  mounted() {
    this.initThreeScene();
  },
  methods: {
    initThreeScene() {
      // 创建渲染器
      const renderer = new THREE.WebGLRenderer();
      renderer.setSize(window.innerWidth, window.innerHeight);
      this.$refs.canvasContainer.appendChild(renderer.domElement);

      // 创建场景
      const scene = new THREE.Scene();

      // 创建相机
      const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
      camera.position.set(0, 0, 5);
      camera.lookAt(0, 0, 0);

      // 创建物体
      const geometry = new THREE.BoxGeometry();
      const material = new THREE.MeshBasicMaterial({ color: 0x00ff00 });
      const cube = new THREE.Mesh(geometry, material);
      scene.add(cube);

      // 添加光源
      const light = new THREE.PointLight(0xffffff, 1, 100);
      light.position.set(0, 0, 5);
      scene.add(light);

      // 添加元素
      const textGeometry = new THREE.TextGeometry('预约停车位系统', {
        font: new THREE.FontLoader().load('path/to/font.json'),
        size: 0.5,
        height: 0.1,
      });
      const textMaterial = new THREE.MeshBasicMaterial({ color: 0x0000ff });
      const textMesh = new THREE.Mesh(textGeometry, textMaterial);
      textMesh.position.set(0, 1, 0);
      scene.add(textMesh);

      const carGeometry = new THREE.BoxGeometry(1, 0.5, 0.5);
      const carMaterial = new THREE.MeshBasicMaterial({ color: 0xff0000 });
      const car = new THREE.Mesh(carGeometry, carMaterial);
      car.position.set(0, -1, 0);
      scene.add(car);

      const parkingGeometry = new THREE.BoxGeometry(2, 1, 0.1);
      const parkingMaterial = new THREE.MeshBasicMaterial({ color: 0x808080 });
      const parking = new THREE.Mesh(parkingGeometry, parkingMaterial);
      parking.position.set(0, -2, 0);
      scene.add(parking);

      // 动画循环
      const animate = () => {
        requestAnimationFrame(animate);

        cube.rotation.x += 0.01;
        cube.rotation.y += 0.01;

        renderer.render(scene, camera);
      };

      animate();
    }
  }
};
</script>

<style scoped>
.three-scene {
  width: 100%;
  height: 100vh;
}
</style>
