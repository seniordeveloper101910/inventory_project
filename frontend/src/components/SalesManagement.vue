<template>
  <div class="p-4 bg-white rounded shadow">
    <h2 class="text-xl mb-4">Sales</h2>
    <div v-for="s in sales" :key="s.id" class="p-2 border-b">
      <div class="flex justify-between">
        <div>{{ s.id }} — {{ s.product_name }}</div>
        <div>{{ s.qty }} pcs</div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, onMounted } from 'vue'
import { useStore } from 'vuex'
const store = useStore()
const sales = computed(()=>store.state.sales.list)
onMounted(()=> store.dispatch('sales/fetch'))
</script>
