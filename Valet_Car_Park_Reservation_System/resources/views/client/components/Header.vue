<template>
<div class="container-fluid">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">

      <RouterLink to="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none navbar-brand">
          <p>Home logo</p>
      </RouterLink>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <RouterLink to="/"><li><a href="#" class="nav-link px-2 link-secondary">Home</a></li></RouterLink>
        <RouterLink to="/booking"><li><a href="#" class="nav-link px-2 link-dark">Booking</a></li></RouterLink>
        <RouterLink to="#"><li><a href="#" class="nav-link px-2 link-dark">Pricing</a></li></RouterLink>
        <RouterLink to="/tutorial"><li><a href="#" class="nav-link px-2 link-dark">Tutorial</a></li></RouterLink>
        <RouterLink to="/about"><li><a href="#" class="nav-link px-2 link-dark">About</a></li></RouterLink>
      </ul>

      <div class="col-md-3 text-end">
        <RouterLink to="/login"><button type="button" class="btn btn-outline-primary me-2">Login</button></RouterLink>
        <RouterLink to="/signup"><button type="button" class="btn btn-primary">Sign-up</button></RouterLink>
      </div>
    </header>
</div>
</template>
