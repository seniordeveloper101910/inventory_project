<template>
  <div>
    <h1>Products</h1>
    <button @click="fetch">Refresh</button>
    <ul>
      <li v-for="p in products" :key="p.id">
        {{ p.name }} — SKU: {{ p.sku }} — Stock: {{ p.stock_qty }}
      </li>
    </ul>
    <hr/>
    <h3>Add sample product</h3>
    <form @submit.prevent="add">
      <input v-model="newProduct.name" placeholder="Name" required/>
      <input v-model="newProduct.sku" placeholder="SKU" required/>
      <button type="submit">Add</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import api from '../api/axios'

const products = ref([])
const newProduct = ref({ name: '', sku: '' })

async function fetch() {
  try {
    const res = await api.get('/products')
    products.value = res.data
  } catch (e) {
    console.error(e)
    products.value = []
  }
}

async function add() {
  await api.post('/products', {
    name: newProduct.value.name,
    sku: newProduct.value.sku,
    price: 0,
    cost: 0,
    stock_qty: 0
  })
  newProduct.value.name = ''
  newProduct.value.sku = ''
  fetch()
}

fetch()
</script>
