<template>
    <el-result
        icon="error"
        title="404"
        sub-title="Page Not Found"
    >
        <template #extra>
          <el-button type="primary" @click="$router.push('/')">Back</el-button>
        </template>
    </el-result>
</template>