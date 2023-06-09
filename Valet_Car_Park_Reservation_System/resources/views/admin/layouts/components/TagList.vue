<template>
    <div class=" tabDiv d-flex align-items-center">
        <el-tabs
            v-model="activeTab"
            type="card"
            @tab-change="changeTab"
            @tab-remove="removeTab"
        >
            <el-tab-pane
                v-for="item in tabList"
                :key="item.path"
                :label="item.title"
                :name="item.path"
                :closable="item.path != '/dashboard'"
            >
            </el-tab-pane>
        </el-tabs>
        <div class="flex-grow-1"/>
        <span class="d-flex align-items-center pe-3">
            <el-dropdown @command="handleClear">
                <span class="el-dropdown-link">
                    <el-icon class="el-icon--right">
                        <arrow-down />
                    </el-icon>
                </span>
                <template #dropdown>
                    <el-dropdown-menu>
                        <el-dropdown-item command="clearAll">Clear</el-dropdown-item>
                        <el-dropdown-item command="clearOther">Clear Other</el-dropdown-item>
                    </el-dropdown-menu>
                </template>
            </el-dropdown>
        </span>
    </div>
</template>

<script setup>
    import { useTabList } from '$/modules/useTabList'

    const {
        activeTab,
        tabList,
        changeTab,
        removeTab,
        handleClear
    } = useTabList()
</script>

<style scoped>

    .tabDiv {
        @apply bg-gray-50 h-50px;
    }
    :deep(.el-tabs__header) {
        border: 0 !important;
        @apply my-0;
    }

    :deep(.el-tabs__nav) {
        border: 0 !important;
    }

    :deep(.el-tabs__item) {
        border: 0 !important;
        @apply mx-1 bg-light-100 text-xs h-35px;
    }
</style>