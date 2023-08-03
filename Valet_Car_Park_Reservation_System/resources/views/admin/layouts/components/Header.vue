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

    <div class="p-2">
        <el-avatar
            :size="35"
            src="https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png"
            @click="openProfileModal"
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

    <el-dialog
    title="Edit Profile"
    v-model="profileModalVisible"
    @close="closeProfileModal"
    width="30%"
    >
    <!-- 编写头像修改和自我简介的表单代码 -->
    <el-form>
      <el-form-item label="Profile Image">
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
          <button>Upload image</button>
        </el-upload>
            </el-form-item>
            <el-form-item label="Introduction">
                <el-input v-model="introduction" type="textarea" :rows="4"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="saveProfile">Save</el-button>
            </el-form-item>
    </el-form>
  </el-dialog>
    
    <el-drawer 
        v-model="showDrawer" 
        title="Reset Password" 
        size="30%"
        :close-on-click-modal="false"
    >
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
  const profileImage = ref('')
  const introduction = ref('')

  const openProfileModal = () => {
    profileModalVisible.value = true
  }

  const closeProfileModal = () => {
    profileModalVisible.value = false
  }

 // 头像上传相关逻辑
const uploadEndpoint = '/api/updateProfileImage'

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

const handleAvatarSuccess = (response, file) => {
  // 上传成功后的处理逻辑
  // 更新 profileImage 变量
  profileImage.value = URL.createObjectURL(file.raw)
}

const handleAvatarError = (err, file) => {
  // 上传失败后的处理逻辑
  console.log('Avatar upload failed:', err)
}

const saveProfile = async () => {
  try {
    const response = await fetch('/api/updateProfileImage', {
      method: 'POST',
      headers: {
        'Content-Type': '/api/updateProfileImage'
      },
      body: JSON.stringify({
        image: profileImage.value,
        introduction: introduction.value
      })
    })
    const data = await response.json()
    // handle successful update
  } catch (error) {
    // handle error
  }
}

</script>