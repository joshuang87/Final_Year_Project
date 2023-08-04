<template>
    <head>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="mb-4" style="text-align: center;">Sign Up</h2>
                        <form @submit.prevent="handleSubmit">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="name" v-model="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" v-model="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" v-model="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm-password" class="form-label">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirm-password" v-model="confirmPassword" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <br><br>


  </template>

<script>

export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      confirmPassword: '',
    };
  },
  methods: {
    async handleSubmit() {
        try {
            // Make a POST request to your API to create the user
            const response = await fetch('/api/signup', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                name: this.name,
                email: this.email,
                password: this.password,
                confirmPassword: this.confirmPassword,
            }),
            });

            if (response.ok) {
            // User was created successfully
            alert('Sign up successful!');
            } else {
            // User creation failed
            alert('Sign up failed!');
            }
        }
        catch (error) {
            console.error(error);
        }
    },
  },
};
</script>
