<template><canvas ref="canvas"></canvas></template>
<script setup>
import { onMounted, ref, watch } from 'vue'
import { Chart, BarController, BarElement, CategoryScale, LinearScale, Tooltip, Legend } from 'chart.js'
Chart.register(BarController, BarElement, CategoryScale, LinearScale, Tooltip, Legend)
const props = defineProps({ data:Array })
const canvas = ref()
let chart
onMounted(()=>{
  chart = new Chart(canvas.value,{ type:'bar', data:{
    labels: props.data.map(d=>d.label),
    datasets:[{label:'Stock',data:props.data.map(d=>d.value)}]
  }, options:{responsive:true, maintainAspectRatio:false}})
})
watch(()=>props.data, (newData)=>{
  if(!chart) return
  chart.data.labels = newData.map(d=>d.label)
  chart.data.datasets[0].data = newData.map(d=>d.value)
  chart.update()
})
</script>
<style scoped>
canvas { width:100%; height:300px; }
</style>
