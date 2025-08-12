<script setup lang="ts">
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';

interface Category {
  cat_id: number;
  name: string;
}

interface Report {
  reprt_id: number;
  title: string;
  cat_id: number;
  category?: Category;
  location: string;
  description: string;
  created_at: string;
}

const props = defineProps<{
  reports: Report[];
}>();
</script>

<template>
  <AdminLayout title="All Reports">
    <Head title="Reports Index" />

    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Reports</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Reports</li>
        </ol>
      </div>
    </div>

    <div class="container-fluid mt-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <Link :href="route('report.create')" class="btn btn-primary">
          <i class="fas fa-file-alt me-1"></i> Submit New Report
        </Link>
      </div>

      <div v-if="reports.length === 0" class="text-center p-4 bg-white rounded shadow-sm">
        <p class="h5 text-muted mb-2">No reports have been submitted yet.</p>
        <p class="text-secondary">Be the first to submit an anonymous report.</p>
      </div>

      <div v-else class="card">
        <div class="table-responsive">
          <table class="table table-bordered table-striped mb-0">
            <thead>
              <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Location</th>
                <th>Description</th>
                <th>Submitted On</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="report in reports" :key="report.reprt_id">
                <td>{{ report.title }}</td>
                <td>{{ report.category?.name || 'N/A' }}</td>
                <td>{{ report.location }}</td>
                <td>{{ report.description }}</td>
                <td>{{ new Date(report.created_at).toLocaleDateString() }}</td>
                <td class="text-right">
                  <Link :href="route('report.show', report.reprt_id)" class="btn btn-sm btn-info">
                    View
                  </Link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
