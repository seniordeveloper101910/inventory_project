<template>
  <div>
    <strong>{{ product.name }}</strong> — {{ product.sku }}
  </div>
</template>

<script setup>
defineProps({ product: Object })
</script>
