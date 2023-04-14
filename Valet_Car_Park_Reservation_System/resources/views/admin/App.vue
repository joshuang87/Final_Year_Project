<script setup>
    import { Suspense } from 'vue';
    import { RouterLink,RouterView } from 'vue-router'
</script>

<template>
    <div>
        <h1>Admin Dashboard</h1>
    </div>
    <div>
        <!-- <RouterLink> tag is <a> tag -->
        <RouterLink to="/">Back To Home</RouterLink>
        <RouterLink to="/parkingLots">Parking Lots</RouterLink>
        <RouterLink to="/parkingSpaces">Parking Spaces</RouterLink>
        <RouterLink to="/customers">Customers</RouterLink>
        <RouterLink to="/users">Users</RouterLink>
        <RouterLink to="/Users">Users</RouterLink>
    </div>

    <RouterView v-slot="{ Component }">
        <template v-if="Component">
            <KeepAlive exclude="parkingLotDetails,parkingLotEdit">
                <Suspense>
                <!-- 主要内容 -->
                <component :is="Component"></component>

                <!-- 加载中状态 -->
                <template #fallback>
                    <h3>Loading...</h3>
                </template>
                </Suspense>
            </KeepAlive>
        </template>
    </RouterView>
</template>

<style scoped>
    div a {
        margin-right: 10px;
    }
</style>