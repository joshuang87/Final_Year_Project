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

        <el-card shadow="never">
            <template #header>
            <div class="d-flex">
                <span>Hello and welcome join with us company.</span>
            </div>
            </template>
        </el-card>

        <el-card shadow="never">
            <template #header>
            <div class="d-flex">
                <span>
                </span>
            </div>
            </template>
            <div id="chart"></div>
        </el-card>
    </div>
</template>

<script setup>
    import { getTotalReservation,getData } from '$/api'
    import { ref,onMounted } from 'vue'
    import { IncomeOne,EveryUser,PageTemplate } from '@icon-park/vue-next'
    import Count from '$/layouts/components/Count.vue'
    // import * as echarts from 'echarts'

    const panels = ref([])

    getTotalReservation().then((response)=>{
        panels.value = response
    })
    
//     let myChart = null

//     onMounted(() => {
//   var chartDom = document.getElementById('chart');
//   myChart = echarts.init(chartDom, null, {
//     renderer: 'svg'
//   });

//   var option;
  
//   // 等待 DOM 加载完成后再进行初始化
//   if (chartDom.clientWidth && chartDom.clientHeight) {
//     option = {
//       xAxis: {
//         type: 'category',
//         data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
//       },
//       yAxis: {
//         type: 'value'
//       },
//       series: [
//         {
//           data: [820, 932, 901, 934, 1290, 1330, 1320],
//           type: 'line',
//           smooth: true
//         }
//       ]
//     };

//     option && myChart.setOption(option);
//   } else {
//     // 如果 DOM 尚未加载完成，则等待一段时间后再尝试初始化
//     setTimeout(() => {
//       option = {
//         xAxis: {
//           type: 'category',
//           data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
//         },
//         yAxis: {
//           type: 'value'
//         },
//         series: [
//           {
//             data: [820, 932, 901, 934, 1290, 1330, 1320],
//             type: 'line',
//             smooth: true
//           }
//         ]
//       };

//       option && myChart.setOption(option);
//     }, 500);
//   }
// });
</script>

<style scoped>

    :deep(.el-card__body) {
        @apply flex justify-between p-4;
    }
</style>