<template>
    <div class="p-6">
      <h1 class="text-2xl font-bold mb-4">Create Role</h1>
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block mb-1">Role Name</label>
          <input v-model="form.name" type="text" class="w-full border px-3 py-2 rounded" />
          <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
        </div>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { useForm } from '@inertiajs/vue3'
  
  const form = useForm({
    name: '',
  })
  
  function submit() {
    form.post('/roles')
  }
  </script>
  