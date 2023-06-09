<template>
    <div class="common-layout">
        <el-container>
            <el-aside width="auto">
                <SideBar />
            </el-aside>
            <el-container>
                <el-header class="d-flex align-items-center border-bottom shadow-sm">
                    <Header />
                </el-header>
                <el-main class="p-0">
                    <TagList class="d-flex align-items-center border-bottom shadow-sm"/>

                    <RouterView v-slot="{ Component }" class="p-3">
                        <transition
                            enter-active-class="animate__animated animate__fadeIn animate__delay-1s"
                            leave-active-class="animate__animated animate__fadeOut"
                        >
                            <keep-alive :max="10">
                                <component :is="Component" />
                            </keep-alive>
                        </transition>    
                    </RouterView>
                </el-main>
            </el-container>
        </el-container>
    </div>
</template>

<script setup>
    import Header from "./components/Header.vue"
    import SideBar from "./components/SideBar.vue"
    import TagList from "./components/TagList.vue"
</script>