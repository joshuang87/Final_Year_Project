<template>
    {{  startNum.num.toFixed(0) }}
</template>

<script setup>
    import gsap from 'gsap'
    import { reactive,watch } from 'vue'

    const props = defineProps({
        value: {
            type: Number,
            default: 0
        }
    })

    const startNum = reactive({
        num: 0
    })

    function animation() {
        gsap.to(startNum,{
            duration: 0.5,
            num: props.value
        })
    }

    animation()

    watch(()=>props.value,()=>animation())
</script>