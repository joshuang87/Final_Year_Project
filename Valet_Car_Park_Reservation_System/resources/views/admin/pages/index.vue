<template>
    <div>
        <el-row :gutter="20">
            <el-col :span="6" :offset="0">
                <el-card shadow="hover" class="d-flex">
                    <el-icon><Avatar /></el-icon>
                    <div>
                        Reservation
                    </div>
                    <div>
                        {{ panels }}
                    </div>
                </el-card>
            </el-col>
        </el-row>      
    </div>
</template>

<script setup>
    import { getTotalReservation } from '$/api'
    import { ref } from 'vue'

    const panels = ref([])

    getTotalReservation().then((response)=>{
        panels.value = response
    })
</script>