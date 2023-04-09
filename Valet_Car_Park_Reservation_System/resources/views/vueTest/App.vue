<script setup>
    import { Suspense } from 'vue';
    import { RouterLink,RouterView } from 'vue-router'
    // import { }
</script>

<template>
    <div>
        <h1>Admin Dashboard</h1>
    </div>
    <div>
        <router-link to="/">Back To Home</router-link>
        <router-link to="/allParkingLot">All Parking Lot</router-link>
    </div>
    <Suspense>
        <template #default>
            <div>
                <router-view></router-view>
            </div>
        </template>
        <template #fallback>
            <div>
                Loading Data...
            </div>
        </template>
    </Suspense>
</template>