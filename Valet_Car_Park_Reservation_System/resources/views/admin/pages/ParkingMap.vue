<template>
    <div id="content">
        <grid-layout
            ref="gridlayout" :layout.sync="layout"
            :col-num="30"
            :row-height="120"
            class="layout"
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
    <div class="droppable-element" @drag="drag" @dragend="dragend" draggable="true">Add Box</div>
</template>
  
<script setup>
    import { onMounted, ref } from "vue"
    import { GridLayout, GridItem } from "vue3-drr-grid-layout"
    import "vue3-drr-grid-layout/dist/style.css"

    let mouseXY = {"x": null, "y": null};
    let DragPos = {"x": null, "y": null, "w": 1, "h": 1, "i": null};

    onMounted(()=>{
        document.addEventListener("dragover", function (e) {
            mouseXY.x = e.clientX;
            mouseXY.y = e.clientY;
            console.log(mouseXY.x,mouseXY.y)
        });

        // document.addEventListener('mousemove', function(e) {
        //     console.log('Mouse position:', e.clientX, e.clientY);
        // });

    })
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

    const drag = (e) => {

        // let parentRect = document.getElementById('content').getBoundingClientRect()

        // let mouseInGrid = false

        // if (((mouseXY.x > parentRect.left) && (mouseXY.x < parentRect.right)) && ((mouseXY.y > parentRect.top) && (mouseXY.y < parentRect.bottom))) {
        //     mouseInGrid = true
        // }

        if (mouseInGrid === true && (layout.findIndex(item => item.i === 'drop')) === -1) {
            layout.push({
                x: (this.layout.length * 2) % (this.colNum || 12),
                y: this.layout.length + (this.colNum || 12), // puts it at the bottom
                w: 1,
                h: 1,
                i: 'drop',
            });
        }

        let index = this.layout.findIndex(item => item.i === 'drop')

        // if (index !== -1) {

        //     let el = this.$refs.gridlayout.$children[index];

        //     el.dragging = {"top": mouseXY.y - parentRect.top, "left": mouseXY.x - parentRect.left};
            
        //     let new_pos = el.calcXY(mouseXY.y - parentRect.top, mouseXY.x - parentRect.left);

        //     if (mouseInGrid === true) {
        //         this.$refs.gridlayout.dragEvent('dragstart', 'drop', new_pos.x, new_pos.y, 1, 1);
        //         DragPos.i = String(index);
        //         DragPos.x = this.layout[index].x;
        //         DragPos.y = this.layout[index].y;
        //     }

            if (mouseInGrid === false) {
                this.$refs.gridlayout.dragEvent('dragend', 'drop', new_pos.x, new_pos.y, 1, 1);
                this.layout = this.layout.filter(obj => obj.i !== 'drop');
            }

        // }
    }

    // const dragend = (e) => {

    //     let parentRect = document.getElementById('content').getBoundingClientRect()

    //     let mouseInGrid = false

    //     if (((mouseXY.x > parentRect.left) && (mouseXY.x < parentRect.right)) && ((mouseXY.y > parentRect.top) && (mouseXY.y < parentRect.bottom))) {
    //             mouseInGrid = true;
    //     }

        if (mouseInGrid === true) {
            alert(`Dropped element props:\n${JSON.stringify(DragPos, ['x', 'y', 'w', 'h'], 2)}`);
            this.$refs.gridlayout.dragEvent('dragend', 'drop', DragPos.x, DragPos.y, 1, 1);
            this.layout = this.layout.filter(obj => obj.i !== 'drop');

            this.layout.push({
                    x: DragPos.x,
                    y: DragPos.y,
                    w: 1,
                    h: 1,
                    i: DragPos.i,
                });
                this.$refs.gridLayout.dragEvent('dragend', DragPos.i, DragPos.x,DragPos.y,1,1);
                try {
                    this.$refs.gridLayout.$children[this.layout.length].$refs.item.style.display="block";
                } catch {
                }
        }
    }
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

    .layout {
        background-color: #000;
        background-color: rgb(171, 171, 171);
        color: #000;
        font-size: 11px;
    }
    
</style>