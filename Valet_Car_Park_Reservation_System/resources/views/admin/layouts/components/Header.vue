<template>
    <div>
        <el-icon :size="25" @click="collapse">
            <Fold v-if="$store.state.isCollapse == false"/>
            <Expand v-else/>
        </el-icon>
    </div>
</template>

<script setup>
    import { useStore } from 'vuex'

    const store = useStore()

    const collapse = ()=>{
        store.dispatch('collapse')
    }

</script>