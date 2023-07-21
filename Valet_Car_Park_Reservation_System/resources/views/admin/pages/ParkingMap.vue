<template>
    <div class="droppable-element" @click="add">添加单元格</div>
    <div id="content">
        <grid-layout
            v-model:layout="layout"
            :col-num="12"
            :row-height="30"
        >
            <template #default="{ gridItemProps }">
                <grid-item
                    v-for="item in layout"
                    :key="item.i"
                    v-bind="gridItemProps"
                    :x="item.x"
                    :y="item.y"
                    :w="item.w"
                    :h="item.h"
                    :i="item.i"
                >
                    <div class="item">
                        <label>
                            {{ item.i }}
                        </label>
                        <span @click="del(item.i)">
                            删除x
                        </span>
                    </div>
                </grid-item>
            </template>
        </grid-layout>
    </div>
</template>
  
<script setup>
    import { getCurrentInstance, onMounted, ref } from "vue"
    import { GridLayout, GridItem } from "vue3-drr-grid-layout"
    import "vue3-drr-grid-layout/dist/style.css"

    const layout = ref([
        { x: 0, y: 0, w: 2, h: 2, i: 0 },
        { x: 2, y: 0, w: 2, h: 2, i: 1 },
        { x: 4, y: 0, w: 2, h: 2, i: 2 },
        { x: 0, y: 1, w: 6, h: 2, i: 3 },
    ]);
  
  //删除单元格
    const del = (i) => {
        layout.value = layout.value.filter((a) => a.i != i);
    };
    
    //添加一个单元格
    const add = () => {
        let y = 0;
        layout.value.forEach((a) => {
        if (a.y > y) y = a.y + 1;
        });
        layout.value.push({
        x: 0,
        y: y,
        w: 2,
        h: 2,
        i: layout.value.length,
        });
    };
</script>
  
<style scoped>

    .droppable-element {
        width: 120px;
        text-align: center;
        background: #fdd;
        border: 1px solid black;
        margin: 10px 0;
        padding: 10px;
    }
    .item {
        display: flex;
        justify-content: space-between;
    }
    .item > span {
        margin-left: 10px;
        padding: 1px;
        border: solid 1px #ddd;
        cursor: pointer;
        background-color: rgb(171, 171, 171);
        color: #000;
        font-size: 11px;
    }
    
</style>