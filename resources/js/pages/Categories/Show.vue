<script setup lang="ts">
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';

interface Category {
  id: number;
  name: string;
}

const props = defineProps<{ category: Category }>();
</script>

<template>
  <AdminLayout title="Category Details">
    <Head title="Category Details" />

    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Category Details</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><Link href="/">Home</Link></li>
          <li class="breadcrumb-item"><Link href="/categories">Categories</Link></li>
          <li class="breadcrumb-item active">Details</li>
        </ol>
      </div>
    </div>

    <div class="card w-50">
      <div class="card-body">
        <h5 class="card-title">Category Name</h5>
        <p class="card-text">{{ props.category.name }}</p>

        <Link href="/categories" class="btn btn-secondary">Back to Categories</Link>
        <Link :href="`/categories/${props.category.id}/edit`" class="btn btn-primary ms-2">Edit</Link>
      </div>
    </div>
  </AdminLayout>
</template>
