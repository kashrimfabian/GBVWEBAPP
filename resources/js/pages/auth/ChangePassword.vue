<script setup>
import AdminLayout from '@/layouts/AdminLayout.vue'
import { useForm } from '@inertiajs/vue3'
import Swal from 'sweetalert2'

// Laravel expects: current_password, password, password_confirmation
const form = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
})

function submit() {
  form.put(route('password.update'), {
    onSuccess: () => {
      Swal.fire({
        icon: 'success',
        title: 'Password Updated',
        text: 'Your password has been changed successfully.',
        timer: 2000,
        showConfirmButton: false
      })
      form.reset()
    },
    onError: (errors) => {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Please check the form for errors.',
      })
      console.error(errors)
    }
  })
}
</script>

<template>
  <AdminLayout>
    <div class="container mt-5">
      <h3 class="mb-4">Change Password</h3>

      <form @submit.prevent="submit">
        <!-- Current Password -->
        <div class="form-group mb-3">
          <label for="current_password">Current Password</label>
          <input
            type="password"
            id="current_password"
            v-model="form.current_password"
            class="form-control"
            placeholder="Enter your current password"
          />
          <div v-if="form.errors.current_password" class="text-danger small">
            {{ form.errors.current_password }}
          </div>
        </div>

        <!-- New Password -->
        <div class="form-group mb-3">
          <label for="password">New Password</label>
          <input
            type="password"
            id="password"
            v-model="form.password"
            class="form-control"
            placeholder="Enter new password"
          />
          <div v-if="form.errors.password" class="text-danger small">
            {{ form.errors.password }}
          </div>
        </div>

        <!-- Confirm New Password -->
        <div class="form-group mb-4">
          <label for="password_confirmation">Confirm New Password</label>
          <input
            type="password"
            id="password_confirmation"
            v-model="form.password_confirmation"
            class="form-control"
            placeholder="Confirm new password"
          />
        </div>

        <!-- Submit Button -->
        <button
          type="submit"
          class="btn btn-primary"
          :disabled="form.processing"
        >
          <span
            v-if="form.processing"
            class="spinner-border spinner-border-sm me-2"
          ></span>
          Change Password
        </button>
      </form>
    </div>
  </AdminLayout>
</template>
