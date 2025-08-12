<script setup>
import AdminLayout from '@/layouts/AdminLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'
import Swal from 'sweetalert2'

defineProps({ users: Array })

// Reset password
function resetPassword(id) {
  Swal.fire({
    title: 'Reset Password?',
    text: 'This will reset the password to the default (GBVWEBAPP).',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, Reset',
    cancelButtonText: 'Cancel',
    customClass: {
      popup: 'swal2-small-popup'
    },
    allowOutsideClick: false
  }).then((result) => {
    if (result.isConfirmed) {
      router.post(route('users.reset-password', id), {}, {
        onSuccess: () => {
          Swal.fire('Success', 'Password has been reset.', 'success')
        }
      })
    }
  })
}

// Enable/Disable user
function toggleStatus(id, status) {
  Swal.fire({
    title: status ? 'Disable User?' : 'Enable User?',
    text: status
      ? 'The user will no longer be able to log in.'
      : 'The user will be able to log in again.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: status ? 'Yes, Disable' : 'Yes, Enable',
    cancelButtonText: 'Cancel',
    customClass: {
      popup: 'swal2-small-popup'
    },
    allowOutsideClick: false
  }).then((result) => {
    if (result.isConfirmed) {
      router.post(route('users.toggle-status', id), {}, {
        onSuccess: () => {
          Swal.fire('Updated', 'User status updated successfully.', 'success')
        }
      })
    }
  })
}
</script>

<template>
  <Head title="Manage Users" />

  <AdminLayout>
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Users</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Users</li>
        </ol>
      </div>
    </div>

    <div class="container-fluid mt-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <Link href="/users/create" class="btn btn-primary">
          <i class="fas fa-user-plus"></i> Add User
        </Link>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(user, index) in users" :key="user.id">
              <td>{{ index + 1 }}</td>
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
              <td>{{ user.role?.name || 'N/A' }}</td>
              <td>
                <span :class="user.status ? 'text-success' : 'text-danger'">
                  {{ user.status ? 'Active' : 'Disabled' }}
                </span>
              </td>
              <td>{{ new Date(user.created_at).toLocaleDateString() }}</td>
              <td>
                <div class="d-flex gap-2">
                  <button
                    class="btn btn-warning btn-sm d-flex align-items-center"
                    @click="resetPassword(user.id)"
                    title="Reset Password"
                  >
                    <i class="fas fa-key me-1"></i> Reset
                  </button>

                  <button
                    :class="user.status ? 'btn btn-danger btn-sm d-flex align-items-center' : 'btn btn-success btn-sm d-flex align-items-center'"
                    @click="toggleStatus(user.id, user.status)"
                    :title="user.status ? 'Disable User' : 'Enable User'"
                  >
                    <i :class="user.status ? 'fas fa-user-slash me-1' : 'fas fa-user-check me-1'"></i>
                    {{ user.status ? 'Disable' : 'Enable' }}
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AdminLayout>
</template>

<style>
.swal2-small-popup {
  width: 400px;
}
</style>