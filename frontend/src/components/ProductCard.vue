<template>
  <div class="border rounded p-3 bg-white shadow-sm">
    <h3 class="font-semibold">{{ product.name }}</h3>
    <p class="text-sm text-gray-500">{{ product.category }}</p>
    <p class="mt-1">Stock: <span :class="product.stock < 10 ? 'text-red-500' : 'text-green-600'">{{ product.stock }}</span></p>
  </div>
</template>

<script setup>
defineProps({ product: Object })
</script>
