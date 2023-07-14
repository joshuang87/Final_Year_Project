<template>
  <div class="profile-page">
    <div class="profile-header">
      <img :src="profilePhoto" alt="Profile Photo" class="profile-photo" />
      <button @click="openPhotoModal">Change Photo</button>
    </div>
    <div class="profile-details">
      <div class="profile-section">
        <div class="section-title">Username</div>
        <div class="section-content">
          <span>{{ username }}</span>
          <button @click="openUsernameModal">Edit</button>
        </div>
      </div>
      <div class="profile-section">
        <div class="section-title">Email</div>
        <div class="section-content">
          <span>{{ email }}</span>
          <button @click="openEmailModal">Change</button>
        </div>
      </div>
      <div class="profile-section">
        <div class="section-title">Password</div>
        <div class="section-content">
          <button @click="openPasswordModal">Change</button>
        </div>
      </div>
      <div class="profile-section">
        <div class="section-title">Bio</div>
        <div class="section-content">
          <span>{{ bio }}</span>
          <button @click="openBioModal">Edit</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      profilePhoto: './default-profile-photo.jpg',
      username: 'JohnDoe',
      email: 'johndoe@example.com',
      bio: 'Hello, I am John Doe.',
    };
  },
  methods: {
    openPhotoModal() {
      // Code to open the photo modal
    },
    openUsernameModal() {
      // Code to open the username modal
    },
    openEmailModal() {
      // Code to open the email modal
    },
    openPasswordModal() {
      // Code to open the password modal
    },
    openBioModal() {
      // Code to open the bio modal
    },
  },
};
</script>

<style scoped>
.profile-page {
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
}

.profile-header {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 20px;
}

.profile-photo {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  object-fit: cover;
}

.profile-details {
  background-color: #f5f5f5;
  padding: 20px;
}

.profile-section {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 10px;
}

.section-title {
  font-weight: bold;
}

.section-content {
  display: flex;
  align-items: center;
}

button {
  margin-left: 10px;
}
</style>