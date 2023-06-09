<script setup>
    import { Suspense } from 'vue';
    import { RouterLink,RouterView } from 'vue-router'
</script>

<template>
    <div>
        <h1>Admin Dashboard</h1>
    </div>
    <div>
        <!-- <router-link> tag is <a> tag -->
        <router-link to="/">Back To Home</router-link>
        <router-link to="/allParkingLot">All Parking Lot</router-link>
    </div>

    <RouterView v-slot="{ Component }">
        <template v-if="Component">
            <KeepAlive>
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