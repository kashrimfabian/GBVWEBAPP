<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'

defineProps({ roles: Array })

const form = useForm({
  name: '',
  email: '',
  // password: '',
  // password_confirmation: '',
  role_id: ''
})

function submit() {
  form.post('/users')
}
</script>

<template>
  <Head title="Create User" />

  <AdminLayout>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0">Register New User</h5>
            </div>
            <div class="card-body">
              <form @submit.prevent="submit">

                <!-- Name -->
                <div class="mb-3">
                  <label class="form-label">Full Name</label>
                  <input v-model="form.name" type="text" class="form-control" placeholder="Enter full name" />
                  <div v-if="form.errors.name" class="text-danger mt-1">{{ form.errors.name }}</div>
                </div>

                <!-- Email -->
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input v-model="form.email" type="email" class="form-control" placeholder="Enter email" />
                  <div v-if="form.errors.email" class="text-danger mt-1">{{ form.errors.email }}</div>
                </div>

                <!-- Password 
                <div class="mb-3">
                  <label class="form-label">Password</label>
                  <input v-model="form.password" type="password" class="form-control" placeholder="Enter password" />
                  <div v-if="form.errors.password" class="text-danger mt-1">{{ form.errors.password }}</div>
                </div>

                
                <div class="mb-3">
                  <label class="form-label">Confirm Password</label>
                  <input v-model="form.password_confirmation" type="password" class="form-control" placeholder="Re-enter password" />
                  <div v-if="form.errors.password_confirmation" class="text-danger mt-1">{{ form.errors.password_confirmation }}</div>
                </div>-->

                <!-- Role -->
                <div class="mb-3">
                  <label class="form-label">Role</label>
                  <select v-model="form.role_id" class="form-select">
                    <option disabled value="">Select a role</option>
                    <option v-for="role in roles" :key="role.role_id" :value="role.role_id">
                      {{ role.name }}
                    </option>
                  </select>
                  <div v-if="form.errors.role_id" class="text-danger mt-1">{{ form.errors.role_id }}</div>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary">Create User</button>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
