<script setup lang="ts">
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { defineProps } from 'vue';

interface Category {
  cat_id: number;
  name: string;
}

const props = defineProps<{ category: Category }>();

const name = ref(props.category.name);
const errors = ref<Record<string, string>>({});

function submit() {
  errors.value = {};
  router.put(`/categories/${props.category.cat_id}`, { name: name.value }, {
    onError: (e) => {
      errors.value = e;
    },
    onSuccess: () => {
      router.visit('/categories');
    }
  });
}
</script>

<template>
  <AdminLayout title="Edit Category">
    <Head title="Edit Category" />

    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Category</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><Link href="/">Home</Link></li>
          <li class="breadcrumb-item"><Link href="/categories">Categories</Link></li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </div>
    </div>

    <form @submit.prevent="submit" class="w-50">
      <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input
          v-model="name"
          type="text"
          id="name"
          class="form-control"
          :class="{ 'is-invalid': errors.name }"
        />
        <div v-if="errors.name" class="invalid-feedback">{{ errors.name }}</div>
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
      <Link href="/categories" class="btn btn-secondary ms-2">Cancel</Link>
    </form>
  </AdminLayout>
</template>
