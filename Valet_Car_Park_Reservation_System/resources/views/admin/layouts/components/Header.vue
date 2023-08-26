<template>
    <el-icon :size="25" @click="collapse">
        <Fold v-if="$store.state.isCollapse == false" />
        <Expand v-else />
    </el-icon>
    <div class="flex-grow-1" />

    <div class="p-2 d-flex align-items-center">
        <el-icon :size="25" @click="toggle">
            <full-screen v-if="!isFullscreen"/>
            <Aim v-else/>
        </el-icon>
    </div>

     <!-- 添加头像点击事件，弹出管理员个人信息对话框 -->
     <div class="p-2" @click="openAdminProfileDialog">
    <el-avatar
      :size="35"
      src="https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png"
    />
  </div>
    <div class="d-flex align-items-center p-2">
        <el-dropdown @command="handleCommand">
            <span class="d-flex align-items-center">
                {{ $store.state.user.userInfo.name }}
                <el-icon class="el-icon--right">
                    <arrow-down />
                </el-icon>
            </span>
            <template #dropdown>
                <el-dropdown-menu>
                    <el-dropdown-item command="showProfile">Profile</el-dropdown-item>
                    <el-dropdown-item command="resetPassword">Reset Password</el-dropdown-item>
                    <el-dropdown-item command="logout" divided>Logout</el-dropdown-item>
                </el-dropdown-menu>
            </template>
        </el-dropdown>
    </div>
  
  <!-- 管理员个人信息对话框 -->
  <el-dialog
    title="Admin Profile"
    v-model="adminProfileDialogVisible"
    @close="closeAdminProfileDialog"
    width="50%"
  >
    <div class="d-flex justify-content-center align-items-center flex-column">
      <img
        src="https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png"
        class="rounded-circle"
        style="width: 50px; height: 50px;"
      />
      <h4 class="mt-2">Admin</h4>
    </div>
    <el-form>
      <el-form-item label="User Name">
        <p>{{ $store.state.user.userInfo.name }}</p>
      </el-form-item>
      <el-form-item label="User Email">
        <p>User Email</p>
      </el-form-item>
      <el-form-item label="Birth Month">
        <p>January</p>
      </el-form-item>
      <el-form-item label="Introduction">
        <el-input
          v-model="adminIntroduction"
          type="textarea"
          :rows="4"
          readonly
        ></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="openProfileModal">Edit Profile</el-button>

        <el-upload
          class="avatar-uploader"
          :action="uploadEndpoint"
          :show-file-list="false"
          :before-upload="beforeAvatarUpload"
          :on-success="handleAvatarSuccess"
          :on-error="handleAvatarError"
        >
          <img v-if="profileImage" :src="profileImage" class="avatar">
          <i v-else class="el-icon-plus avatar-uploader-icon"></i>
          <br><br><br><br><br>
          <el-button type="primary">Change Your Image</el-button>
        </el-upload>
      </el-form-item>
    </el-form>
  </el-dialog>
  <el-dialog
    title="Edit Profile"
    v-model="profileModalVisible"
    @close="closeProfileModal"
    width="30%"
  >
    <el-form>
      <el-form-item label="Profile Image">
  <input type="file" accept="image/*" @change="handleFileChange" />
        <el-upload
          class="avatar-uploader"
          :action="uploadEndpoint"
          :show-file-list="false"
          :before-upload="beforeAvatarUpload"
          :on-success="handleAvatarSuccess"
          :on-error="handleAvatarError"
        >
          <img v-if="profileImage" :src="profileImage" class="avatar" style="height: 100px; width: 100px;"  />
          <i v-else class="el-icon-plus avatar-uploader-icon" ></i>
          <br><br><br><br><br>
          <el-button type="primary">Change Your Image</el-button>
        </el-upload>
      </el-form-item>
      <el-form-item label="User Name">
        <el-input v-model="$store.state.user.userInfo.name" />
      </el-form-item>
      <el-form-item label="Birth Month">
        <el-select v-model="birthMonth">
          <el-option label="January" value="January" />
          <el-option label="February" value="February" />
          <el-option label="March" value="March" />
          <el-option label="April" value="April" />
          <el-option label="May" value="May" />
          <el-option label="June" value="June" />
          <el-option label="July" value="July" />
          <el-option label="August" value="August" />
          <el-option label="September" value="September" />
          <el-option label="October" value="October" />
          <el-option label="November" value="November" />
          <el-option label="December" value="December" />
          
        </el-select>
      </el-form-item>
      <el-form-item label="Introduction">
        <el-input v-model="introduction" type="textarea" :rows="4" />
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="onSubmit">Save</el-button>
      </el-form-item>
    </el-form>
  </el-dialog>
    
    <el-drawer v-model="showDrawer" title="Reset Password" size="30%" :close-on-click-modal="false">
            <el-form ref="formRef" :rules="rules" :model="form" @keyup.enter="onSubmit" label-width="150px">
                <el-form-item label="Old Password" prop="oldPassword">
                    <el-input v-model="form.oldPassword" show-password placeholder="Please Input Old Password" type="password"/>
                </el-form-item>
                <el-form-item label="New Password" prop="newPassword">
                    <el-input v-model="form.newPassword" show-password placeholder="Please Input New Password" type="password"/>
                </el-form-item>
                <el-form-item label="Confirm Password" prop="confirmPassword">
                    <el-input v-model="form.confirmPassword" show-password placeholder="Please Confirm Your Password"/>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit"  :loading="loading">Reset</el-button>
                </el-form-item>
            </el-form>
    </el-drawer>
</template>

<script setup>
    import { ref } from 'vue'
    import { useStore } from "vuex"
    import { useFullscreen } from '@vueuse/core'
    import { useUpdatePassword,useLogout } from '$/modules/useManager' 
    import { updateProfileImage } from '$/api/manager';

    const store = useStore()

    // Drawer State
    const showDrawer = ref(false)

    const collapse = () => {
        store.dispatch("collapse")
    }

    const { isFullscreen,toggle } = useFullscreen()

    const {
        form,
        formRef,
        loading,
        rules,
        onSubmit
    } = useUpdatePassword()

    const {
        handleLogout
    } = useLogout()

    const handleCommand = (response)=>{
        switch(response) {
            case 'logout':
                handleLogout()
                break
            case 'resetPassword' :
                showDrawer.value = true
                break
            case 'showProfile':
                profileModalVisible.value = true
                break
        }
    }

    // Profile Modal State
  const profileModalVisible = ref(false)
  const profileImage = ref('images/avatar.png')
  const introduction = ref('')
  const profileImageFile = ref(null);

  // 这些是用来绑定用户信息的变量
  const userName = ref('User Name');
  const userEmail = ref('User Email');
  const birthMonth = ref('January');


  const openProfileModal = () => {
    profileModalVisible.value = true
  }

  const closeProfileModal = () => {
    profileModalVisible.value = false
  }

    // 管理员个人信息对话框相关逻辑
  const adminProfileDialogVisible = ref(false)
  const adminIntroduction = ref('Administrator Introduction')

  const openAdminProfileDialog = () => {
    adminProfileDialogVisible.value = true
  }

  const closeAdminProfileDialog = () => {
    adminProfileDialogVisible.value = false
  }

  const openAdminEditProfileDialog = () => {
    // Logic to open the edit profile dialog for admin
  }

  const openAdminChangeAvatarDialog = () => {
    // Logic to open the change avatar dialog for admin
  }

 // 头像上传相关逻辑
const uploadEndpoint = '/api/admin/updateProfileImage'

const beforeAvatarUpload = (file) => {
  const isJPG = file.type === 'image/jpeg'
  const isPNG = file.type === 'image/png'
  const isLt2M = file.size / 1024 / 1024 < 2

  if (!isJPG && !isPNG) {
    // 校验文件类型，只支持 JPEG 和 PNG
    // 返回 false 可以取消上传
    return false
  }

  if (!isLt2M) {
    // 校验文件大小，限制为 2MB 以下
    // 返回 false 可以取消上传
    return false
  }

  return true
}


const handleFileChange = (event) => {
  profileImageFile.value = event.target.files[0];
};

const handleAvatarSuccess = (response, file) => {
  // 上传成功后的处理逻辑
  // 更新 profileImage 变量
  profileImage.value = response.filePath;
}
const handleAvatarError = (err, file) => {
  // 上传失败后的处理逻辑
  console.log('Avatar upload failed:', err)
}

const saveProfile = async () => {
  try {
    const response = await axios('/api/updateProfileImage', {
      method: 'POST',
      headers: {
        'Content-Type': '/api/updateProfileImage'
      },
      body: JSON.stringify({
        image: profileImage.value,
        introduction: introduction.value
      })
    })
    const data = await response.json();
    // 根据后端返回的情况进行相应的处理
    if (data.success) {
      // 成功处理
      // 关闭对话框等操作
    } else {
      // 失败处理
      // 提示用户保存失败等
    }
  } catch (error) {
    // 处理错误
  }
}

</script>