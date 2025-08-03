<template>
    <div class="p-6">
      <h1 class="text-2xl font-bold mb-4">Edit Role</h1>
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block mb-1">Role Name</label>
          <input v-model="form.name" type="text" class="w-full border px-3 py-2 rounded" />
          <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { useForm } from '@inertiajs/vue3'
  const props = defineProps({ role: Object })
  
  const form = useForm({
    name: props.role.name,
  })
  
  function submit() {
    form.put(`/roles/${props.role.id}`)
  }
  </script>
  