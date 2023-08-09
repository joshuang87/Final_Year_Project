<template>
    <div>
        <div class="layoutJSON">
            Displayed as <code>[x, y, w, h]</code>:
            <div class="columns">
                <div class="layoutItem" v-for="item in layout" :key="item.i">
                    <b>{{item.i}}</b>: [{{item.x}}, {{item.y}}, {{item.w}}, {{item.h}}]
                </div>
            </div>
        </div>
        <button @click="addItem">Add an item dynamically</button>
        <input type="checkbox" v-model="draggable" /> Draggable
        <input type="checkbox" v-model="resizable" /> Resizable
        <grid-layout :layout.sync="layout"
                     :col-num="colNum"
                     :row-height="80"
                     :is-draggable="draggable"
                     :is-resizable="resizable"
                     :vertical-compact="false"
                     :prevent-collision="true"
                     :use-css-transforms="true"
        >
            <grid-item v-for="item in layout"
                       :static="item.static"
                       :x="item.x"
                       :y="item.y"
                       :w="item.w"
                       :h="item.h"
                       :i="item.i"
                       :key="item.i"
            >
                <span class="text">{{item.i}}</span>
                <span class="remove" @click="removeItem(item.i)">x</span>
            </grid-item>
        </grid-layout>
    </div>
</template>

<script setup>
    import axios from 'axios';
    import { ref,onMounted} from 'vue'
    import { useStore } from 'vuex'

    const store = useStore()
    let parkingLotId = store.state.parkingLotId
    const getLayout = async() => {
        try {
            const response = await axios.get('api/parkingSpace/filter/' + parkingLotId)
            const data = response.data

            return data
        }
        catch(error) {
            console.log(error)
        }
    }

    const pLotLayout = await getLayout()

    const layout = ref(
        // [
        //     { x: 0, y: 0, w: 1, h: 1, i: "haha" },
        //     { x: 1, y: 0, w: 1, h: 1, i: "1" },
        //     { x: 2, y: 0, w: 1, h: 1, i: "2" },
        //     { x: 3, y: 0, w: 1, h: 1, i: "3" },
        //     { x: 4, y: 0, w: 1, h: 1, i: "4" },
        // ]
        pLotLayout
    )

    console.log(pLotLayout);
    const draggable = ref(true)
    const resizable = ref(true)
    let colNum = 12
    let index = 0

    onMounted(() => {
        index = layout.value.length
    })

    const addItem = () => {
        // Add a new item. It must have a unique key!
        layout.value.push({
            x: (layout.value.length * 2) % (colNum || 12),
            y: layout.value.length + (colNum || 12), // puts it at the bottom
            w: 2,
            h: 2,
            i: index,
        });
        // Increment the counter to ensure key is always unique.
        index++;
    }

    const removeItem = (val) => {
        const index = layout.value.map(item => item.i).indexOf(val);
        layout.value.splice(index, 1);
    }

</script>

<style>
.layoutJSON {
    background: #ddd;
    border: 1px solid black;
    margin-top: 10px;
    padding: 10px;
}

.columns {
    -moz-columns: 120px;
    -webkit-columns: 120px;
    columns: 120px;
}

/*************************************/

.remove {
    position: absolute;
    right: 2px;
    top: 0;
    cursor: pointer;
}

.vue-grid-layout {
    background: #eee;
}

.vue-grid-item:not(.vue-grid-placeholder) {
    background: #ccc;
    border: 1px solid black;
}

.vue-grid-item .resizing {
    opacity: 0.9;
}

.vue-grid-item .static {
    background: #cce;
}

.vue-grid-item .text {
    font-size: 24px;
    text-align: center;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    height: 100%;
    width: 100%;
}

.vue-grid-item .no-drag {
    height: 100%;
    width: 100%;
}

.vue-grid-item .minMax {
    font-size: 12px;
}

.vue-grid-item .add {
    cursor: pointer;
}

.vue-draggable-handle {
    position: absolute;
    width: 20px;
    height: 20px;
    top: 0;
    left: 0;
    background: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='10'><circle cx='5' cy='5' r='5' fill='#999999'/></svg>") no-repeat;
    background-position: bottom right;
    padding: 0 8px 8px 0;
    background-repeat: no-repeat;
    background-origin: content-box;
    box-sizing: border-box;
    cursor: pointer;
}


</style>