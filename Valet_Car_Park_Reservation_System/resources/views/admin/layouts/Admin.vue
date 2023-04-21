<template>
    <div class="common-layout">
        <el-container>
            <el-aside width= auto>
                <SideBar/>
            </el-aside>
            <el-container>
                <el-header>
                    <Header/>
                </el-header>
                <el-main>
                    <TagList/>

                    <RouterView v-slot="{ Component }" >
                        <template v-if="Component">
                                <Suspense>
                                    <!-- 主要内容 -->
                                    <component :is="Component"></component>
                            
                                    <!-- 加载中状态 -->
                                    <template #fallback>
                                        <h3>Loading...</h3>
                                    </template>
                                </Suspense>
                        </template>
                    </RouterView>
                </el-main>
            </el-container>
        </el-container>
    </div>
</template>

<script setup>

    import Header from './components/Header.vue'
    import SideBar from './components/SideBar.vue'
    import TagList from './components/TagList.vue'

</script>