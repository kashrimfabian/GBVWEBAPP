<script setup>
import AdminLayout from '@/layouts/AdminLayout.vue'
defineProps({
  roles: Array
})
</script>

<template>
  <AdminLayout>
    <template #header-actions>
      <a
        href="/role/create"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"
      >
        Create Role
      </a>
    </template>

    <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Roles</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Roles</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">#</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Role Name</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          <tr v-for="(role, index) in roles" :key="role.id">
            <td class="px-4 py-2 text-sm text-gray-700">{{ index + 1 }}</td>
            <td class="px-4 py-2 text-sm text-gray-900">{{ role.name }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </AdminLayout>
</template>
