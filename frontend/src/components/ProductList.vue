<template>
  <div class="p-4">
    <div class="flex gap-2 mb-4">
      <input v-model="q" @keyup.enter="apply" placeholder="Search..." class="border px-3 py-2 rounded w-1/2" />
      <button @click="apply" class="bg-sky-600 text-white px-3 py-2 rounded">Filter</button>
    </div>
    <div v-if="loading" class="text-center">Loading...</div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
      <ProductCard v-for="p in items" :key="p.id" :product="p" />
    </div>
  </div>
</template>

<script setup>
import { computed, ref } from 'vue'
import { useStore } from 'vuex'
import ProductCard from './ProductCard.vue'

const store = useStore()
const q = ref('')
const loading = computed(()=>store.state.products.loading)
const items = computed(()=>store.state.products.items)

function apply(){
  store.commit('products/setFilters',{ q:q.value })
  store.dispatch('products/fetch')
}
store.dispatch('products/fetch')
</script>
