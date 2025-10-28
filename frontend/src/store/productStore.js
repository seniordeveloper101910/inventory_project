import { defineStore } from 'pinia'
import api from '../api/axios'

export const useProductStore = defineStore('product', {
  state: () => ({ products: [] }),
  actions: {
    async fetchProducts() {
      const res = await api.get('/products')
      this.products = res.data
    }
  }
})
