<template>
  <div>
    <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>
    <InventoryChart :data="chartData" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import InventoryChart from '../components/charts/InventoryChart.vue'
import api from '../services/api'
const chartData = ref([])
onMounted(async ()=>{
  try {
    const res = await api.get('/products')
    chartData.value = (res.data.items || []).map(p=>({ label:p.name, value:p.stock }))
  } catch (e) { chartData.value = [] }
})
</script>
