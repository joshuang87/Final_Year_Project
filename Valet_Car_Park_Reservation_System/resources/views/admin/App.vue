<template>

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