<template>
    <head>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>


        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h2 class="mb-4" style="text-align: center;">Login</h2>
                            <form @submit.prevent="handleSubmit">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" v-model="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password:</label>
                                    <input type="password" class="form-control" id="password" v-model="password" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </form>
                            <br>
                            <div class="text-center">
                                <p class="mb-0">Don't have an account?</p>
                                <router-link to="/signup" class="link-primary">Sign up here</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  <br><br><br><br>


  </template>

  <script>
//import axios from 'axios'

export default {
  name: 'Login',
  data() {
    return {
      form: {
        email: '',
        password: '',
      },
    }
  },
  methods: {
    login() {
      axios.post('/api/login', this.form)
        .then(response => {
          // Handle successful login
        })
        .catch(error => {
          // Handle login error
        })
    },
  },
}
  </script>
