<template>
  <div class="min-h-screen flex">
    <aside class="w-64 bg-white border-r p-4">
      <h2 class="font-bold mb-4">Inventory</h2>
      <nav>
        <router-link to="/" class="block py-2">Dashboard</router-link>
        <router-link to="/products" class="block py-2">Products</router-link>
        <router-link to="/sales" class="block py-2">Sales</router-link>
        <router-link to="/purchases" class="block py-2">Purchases</router-link>
      </nav>
    </aside>
    <main class="flex-1 p-6 bg-gray-50">
      <div class="flex justify-end mb-4">
        <NotificationBell />
      </div>
      <slot />
    </main>
  </div>
</template>

<script setup>
import NotificationBell from '../components/NotificationBell.vue'
</script>
