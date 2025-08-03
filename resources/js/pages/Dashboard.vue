<script setup lang="ts">
import AdminLayout from '@/layouts/AdminLayout.vue'
import { Head } from '@inertiajs/vue3'
import PlaceholderPattern from '../components/PlaceholderPattern.vue'
</script>

<template>
  <Head title="Dashboard" />

  <AdminLayout>      
  
    <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
      </div><!-- /.row -->
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <PlaceholderPattern />
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <PlaceholderPattern />
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <PlaceholderPattern />
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-body" style="min-height: 300px">
              <PlaceholderPattern />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
