<script setup lang="ts">
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';

interface Category {
  cat_id: number;
  name: string;
}

const props = defineProps<{
  categories: Category[];
}>();
</script>

<template>
  <AdminLayout title="Categories">
    <Head title="Manage Categories" />

    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Categories</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Categories</li>
        </ol>
      </div>
    </div>

    <div class="container-fluid mt-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <Link href="/categories/create" class="btn btn-primary">
          <i class="fas fa-plus"></i> Add Category
        </Link>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(category, index) in categories" :key="category.cat_id">
              <td>{{ index + 1 }}</td>
              <td>{{ category.name }}</td>
              <td>
                <Link
                  :href="`/categories/${category.cat_id}/edit`"
                  class="btn btn-sm btn-info me-2"
                >
                  <i class="fas fa-edit"></i> Edit
                </Link>
                <!-- Add delete functionality as needed -->
              </td>
            </tr>
            <tr v-if="categories.length === 0">
              <td colspan="3" class="text-center">No categories found.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AdminLayout>
</template>
