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
                        <OfficeBuilding />
                    </el-icon>
                    <template #title>Parking Lots</template>
                </el-menu-item>
            </RouterLink>

            <RouterLink to="/parkingSpaces">
                <el-menu-item index="/parkingSpaces">
                    <el-icon>
                        <Place />
                    </el-icon>
                    <template #title>Parking Spaces</template>
                </el-menu-item>
            </RouterLink>

            <RouterLink to="/customers">
                <el-menu-item index="/customers">
                    <el-icon>
                        <Ticket />
                    </el-icon>
                    <template #title>Customers</template>
                </el-menu-item>
            </RouterLink>

            <RouterLink to="/users">
                <el-menu-item index="/users">               
                        <el-icon>
                            <User />
                        </el-icon>              
                        <template #title>Users</template>
                </el-menu-item>
            </RouterLink>
            
            <!-- <RouterLink to="/parkingMap">
                <el-menu-item index="/parkingMap">               
                        <el-icon>
                            <List />
                        </el-icon>              
                        <template #title>Parking Map</template>
                </el-menu-item>
            </RouterLink>  -->
            <el-sub-menu index="1">
                <template #title>
                    <el-icon><location /></el-icon>
                    <span>Parking Map</span>
                </template>
                <el-menu-item-group>
                    <router-link to="/parkingMap">
                        <el-menu-item index="{{ parkingLot.parking_lot_id }}" v-for="parkingLot in parkingLots" @click="getParkingLotId(parkingLot.parking_lot_id)" >
                            {{ parkingLot.parking_lot_id }}
                        </el-menu-item>
                    </router-link>
                </el-menu-item-group>
            </el-sub-menu>
        </el-menu>
    </div>
</template>

<script setup>
    import { ref } from 'vue'
    import { useRoute } from 'vue-router'
    import { getParkingLotData } from '$/api'
    import { useStore } from 'vuex'

    const route = useRoute()
    const store = useStore()

    const defaultActive = ref(route.path)

    const parkingLots = await getParkingLotData()

    const getParkingLotId = (parkingLotId) => {
        store.dispatch('getParkingLotId',parkingLotId)
        console.log(store.state.parkingLotId)
    }
    

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