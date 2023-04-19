<template>
    <div class="common-layout">
        <el-container>
            <el-aside style="width: auto;">
                <el-menu
                    default-active="1"
                    class="el-menu-vertical-demo"
                    :collapse="isCollapse"
                    @open="handleOpen"
                    @close="handleClose"
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
            </el-aside>

            <el-container>
                <el-header>

                    <el-icon :size="25" @click="expend"  v-if="isCollapse == true"><Fold /></el-icon>
                    <el-icon :size="25" @click="open" v-if="isCollapse == false"><Expand /></el-icon>


                        <!-- <el-page-header @back="onBack">
                          <template #breadcrumb>
                            <el-breadcrumb separator="/">
                              <el-breadcrumb-item :to="{ path: './page-header.html' }">
                                Dashboard
                              </el-breadcrumb-item>
                              <el-breadcrumb-item
                                ><a href="./page-header.html">route 1</a></el-breadcrumb-item
                              >
                              <el-breadcrumb-item>route 2</el-breadcrumb-item>
                            </el-breadcrumb>
                          </template>
                        </el-page-header> -->

                </el-header>

                <el-main>
                    <RouterView v-if="isRouterAlive" v-slot="{ Component }" >
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
                </el-main>

            </el-container>
        </el-container>
    </div>
</template>

<script lang="ts">
    import { Suspense } from 'vue';
    import { RouterLink,RouterView } from 'vue-router'
    import { ref } from 'vue'
    import { ElNotification as notify } from 'element-plus'

    export default {
        name: 'App',
        setup() {

            const onBack = () => {
                notify('Back')
            }

            const isCollapse = ref(true)
            const handleOpen = (key: string, keyPath: string[]) => {
            console.log(key, keyPath)
            }
            const handleClose = (key: string, keyPath: string[]) => {
            console.log(key, keyPath)
            }

            return {
                isCollapse,
                handleOpen,
                handleClose,
                onBack
            }
        },
        provide() {
            return {
                reload: this.reload
            }
        },
        data() {
            return {
                isRouterAlive: true,
                transitionName: 'slide-left'
            }
        },
        methods: {
            reload() {
                this.isRouterAlive = false
                this.$nextTick(()=> {
                    this.isRouterAlive = true
                })
            },
            expend() {
                this.isCollapse = false
            },
            open() {
                this.isCollapse = true
            }
        }
    }
</script>

<style scoped>
    div a {
        margin-right: 10px;
        text-decoration: none;
    }

    .el-menu-vertical-demo:not(.el-menu--collapse) {
        width: 200px;
        min-height: 400px;
      }
</style>