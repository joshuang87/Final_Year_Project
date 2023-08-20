<template>
<div class="container">

    <header class="fixed-header d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">

      <RouterLink to="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none navbar-brand zoom-effect">
          <img class="home-logo" src="images/Logo.jpg" alt="">
      </RouterLink>

      <ul class="menu nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 zoom-effect text-decoration-none">
        <RouterLink to="/"><li><a href="#" class="nav-link px-2 link-dark ">Home</a></li></RouterLink>
        <RouterLink to="/booking"><li><a href="#" class="nav-link px-2 link-dark">Booking</a></li></RouterLink>
        <RouterLink to="/about"><li><a href="#" class="nav-link px-2 link-dark">About</a></li></RouterLink>
      </ul>

        <div class="register col-md-3 text-end">
            <RouterLink to="/login"><button type="button" class="btn btn-outline-primary me-2">Login</button></RouterLink>
            <RouterLink to="/signup"><button type="button" class="btn btn-primary">Sign-up</button></RouterLink>

        </div>
    </header>
</div>
</template>

<style>
.fixed-header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  background: linear-gradient(to bottom, white, transparent); /* 调整背景颜色渐变 */
  z-index: 1000;
}

.home-logo {
  margin: 0; /* 清除默认的 margin */
  width: 60px;
  height: 60px;
  object-fit: contain;
}

.menu {
  list-style: none; /* 清除列表样式 */
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
}

.menu li {
  margin-right: 20px; /* 根据需要调整间距 */
}

.register {
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

</style>
