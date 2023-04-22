<template>
    <div>
        <el-menu
            :default-active="defaultActive"
            class="el-menu-vertical-demo"
            :collapse="$store.state.isCollapse"
        >
            <RouterLink to="/dashboard">
                <el-menu-item index="/dashboard">
                    <el-icon>
                        <HomeFilled />
                    </el-icon>
                    <template #title>Dashboard</template>
                </el-menu-item>
            </RouterLink>

            <RouterLink to="/parkingLots">
                <el-menu-item index="/parkingLots">
                    <el-icon>               
                        <List />
                    </el-icon>
                    <template #title>Parking Lots</template>
                </el-menu-item>
            </RouterLink>

            <RouterLink to="/parkingSpaces">
                <el-menu-item index="/parkingSpaces">
                    <el-icon>
                        <List />
                    </el-icon>
                    <template #title>Parking Spaces</template>
                </el-menu-item>
            </RouterLink>

            <RouterLink to="/customers">
                <el-menu-item index="/customers">
                    <el-icon>
                        <List />
                    </el-icon>
                    <template #title>Customers</template>
                </el-menu-item>
            </RouterLink>

            <RouterLink to="/users">
                <el-menu-item index="/users">               
                        <el-icon>
                            <List />
                        </el-icon>              
                        <template #title>Users</template>
                </el-menu-item>
            </RouterLink> 
        </el-menu>
    </div>
</template>

<script setup>
    import { ref } from 'vue'
    import { useRoute } from 'vue-router'

    const route = useRoute()

    const defaultActive = ref(route.path)
</script>

<style scoped>
    a {
        text-decoration: none;
    }

    .el-menu-vertical-demo:not(.el-menu--collapse) {
        width: 200px;
        min-height: 400px;
      }
</style>