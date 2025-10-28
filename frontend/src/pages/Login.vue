<template>
  <div class="h-screen flex items-center justify-center bg-gray-50">
    <form @submit.prevent="login" class="bg-white p-6 rounded shadow w-80">
      <h2 class="text-xl mb-4 text-center">Login</h2>
      <input v-model="email" placeholder="Email" class="w-full border p-2 mb-3 rounded"/>
      <input v-model="password" type="password" placeholder="Password" class="w-full border p-2 mb-4 rounded"/>
      <button class="w-full bg-sky-600 text-white py-2 rounded">Login</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'
const store = useStore(), router = useRouter()
const email = ref(''), password = ref('')
async function login(){
  try{
    await store.dispatch('auth/login',{ email:email.value, password:password.value })
    router.push('/')
  }catch(e){ alert('Login failed') }
}
</script>
