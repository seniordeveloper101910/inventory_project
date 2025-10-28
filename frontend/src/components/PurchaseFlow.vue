<template>
  <div class="p-4 bg-white rounded shadow">
    <h2 class="text-xl mb-4">Create Purchase</h2>
    <form @submit.prevent="submit">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm">Product</label>
          <select v-model="form.product_id" class="w-full border p-2 rounded">
            <option v-for="p in products" :key="p.id" :value="p.id">{{ p.name }}</option>
          </select>
        </div>
        <div>
          <label class="block text-sm">Quantity</label>
          <input v-model.number="form.qty" type="number" min="1" class="w-full border p-2 rounded" />
        </div>
        <div>
          <label class="block text-sm">Unit Price</label>
          <input v-model.number="form.unit_price" type="number" step="0.01" class="w-full border p-2 rounded"/>
        </div>
        <div>
          <label class="block text-sm">Supplier</label>
          <input v-model="form.supplier" class="w-full border p-2 rounded"/>
        </div>
      </div>

      <div class="mt-4">
        <button type="submit" class="bg-sky-600 text-white px-4 py-2 rounded">Submit Purchase</button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useStore } from 'vuex'
import api from '../services/api'

const store = useStore()
const products = store.state.products.items
const form = ref({
  product_id: products?.[0]?.id || null,
  qty: 1,
  unit_price: 0,
  supplier: ''
})

async function submit() {
  try {
    const res = await api.post('/purchases', form.value)
    await store.dispatch('products/fetch')
    store.dispatch('notifications/pushNotification', { type: 'purchase_created', payload: res.data })
    alert('Purchase created')
  } catch (e) {
    console.error(e)
    alert('Failed to create purchase')
  }
}
</script>
