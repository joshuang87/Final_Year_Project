<template>
    <div>
        <el-menu
            default-active="1"
            class="el-menu-vertical-demo"
            :collapse="$store.state.isCollapse"
        >
            <RouterLink to="/">
                <el-menu-item index="1">
                    <el-icon>
                        <HomeFilled />
                    </el-icon>
                    <template #title>Dashboard</template>
                </el-menu-item>
            </RouterLink>

            <RouterLink to="/parkingLots">
                <el-menu-item index="2">
                    <el-icon>               
                        <List />
                    </el-icon>
                    <template #title>Parking Lots</template>
                </el-menu-item>
            </RouterLink>

            <RouterLink to="/parkingSpaces">
                <el-menu-item index="3">
                    <el-icon>
                        <List />
                    </el-icon>
                    <template #title>Parking Spaces</template>
                </el-menu-item>
            </RouterLink>

            <RouterLink to="/customers">
                <el-menu-item index="4">
                    <el-icon>
                        <List />
                    </el-icon>
                    <template #title>Customers</template>
                </el-menu-item>
            </RouterLink>

            <RouterLink to="/users">
                <el-menu-item index="5">               
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