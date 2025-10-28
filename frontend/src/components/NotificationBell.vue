<template>
  <div class="relative">
    <button @click="toggle" class="relative px-2 py-1 rounded hover:bg-gray-100">
      🔔
      <span v-if="unread>0" class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full px-1">{{ unread }}</span>
    </button>
    <div v-if="open" class="absolute right-0 mt-2 w-72 bg-white border rounded shadow-lg z-50">
      <div v-for="n in list" :key="n.id" class="p-2 text-sm border-b">
        <div class="font-medium">{{ n.type }}</div>
        <div class="text-gray-500 text-xs">{{ n.payload?.name }}</div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useStore } from 'vuex'
const store = useStore()
const open = ref(false)
const list = computed(()=>store.state.notifications.list)
const unread = computed(()=>list.value.filter(x=>!x.read).length)
function toggle(){ open.value=!open.value }
</script>
