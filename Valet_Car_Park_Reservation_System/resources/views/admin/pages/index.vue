<template>
    <div class="mx-4">       
        <el-row :gutter="12">

            <template v-if="panels.length == 0">
                <el-col :span="8" v-for="card in 3" :key="card">
                    <el-skeleton style="width: 100%" animated loading>
                        <template #template>
                            <el-card shadow="hover">
                                <div class="d-flex align-items-center">
                                    <el-skeleton style="--el-skeleton-circle-size: 60px">
                                        <template #template>
                                            <el-skeleton-item variant="circle" />
                                        </template>
                                    </el-skeleton>
                                </div>
                                <div class="d-flex flex-column justify-content-between">
                                    <el-skeleton>
                                        <template #template>
                                            <el-skeleton-item variant="text" style="width: 100px;" class="mb-4" />
                                        </template>
                                    </el-skeleton>
                                    <el-skeleton>
                                        <template #template>
                                            <el-skeleton-item variant="text" style="width: 50px" />
                                        </template>
                                    </el-skeleton>
                                </div>
                            </el-card>
                        </template>
                    </el-skeleton>
                </el-col>
            </template>

            <template v-else>
                <el-col :span="8">
                    <el-card shadow="hover">
                        <div class="d-flex align-items-center">
                            <every-user theme="outline" size="60" fill="#333"/>
                        </div>
                        <div class="d-flex flex-column justify-content-between">
                            <div class="fs-5 mb-4">Reservation</div>
                            <div class="fs-6">
                                <Count :value="panels.totalReservation"/>
                            </div>
                        </div>
                    </el-card>
                </el-col>
                <el-col :span="8">
                    <el-card shadow="hover">
                        <div class="d-flex align-items-center">
                            <page-template theme="outline" size="48" fill="#333"/>
                        </div>
                        <div class="d-flex flex-column justify-content-between">
                            <div class="fs-5 mb-4">TEMPLATE</div>
                            <div class="fs-6">
                                EMPTY
                            </div>
                        </div>
                    </el-card>
                </el-col>
                <el-col :span="8">
                    <el-card shadow="hover">
                        <div class="d-flex align-items-center">
                            <income-one theme="outline" size="60" fill="#333"/>
                        </div>
                        <div class="d-flex flex-column justify-content-between">
                            <div class="fs-5 mb-4">Profit</div>
                            <div class="fs-6">
                                RM 
                                <Count :value="panels.totalProfit"/>
                            </div>
                        </div>
                    </el-card>
                </el-col>
            </template>
        </el-row>
    </div>
</template>

<script setup>
    import { getTotalReservation } from '$/api'
    import { ref } from 'vue'
    import { IncomeOne,EveryUser,PageTemplate } from '@icon-park/vue-next'
    import Count from '$/layouts/components/Count.vue'

    const panels = ref([])

    getTotalReservation().then((response)=>{
        panels.value = response
    })

</script>

<style scoped>

    :deep(.el-card__body) {
        @apply flex justify-between p-4;
    }
</style>