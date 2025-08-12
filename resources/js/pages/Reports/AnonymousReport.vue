<template>
    <AppLayout title="Anonymous Report">
      <div class="container mx-auto p-4">
        <h2 class="text-xl font-bold mb-4">Submit Anonymous Report</h2>
  
        <div v-if="success" class="mb-4 text-green-600">
          {{ success }}
        </div>
  
        <form @submit.prevent="submitReport" enctype="multipart/form-data">
          <!-- Title -->
          <div class="mb-4">
            <label for="title" class="block font-semibold mb-1">Title:</label>
            <input
              v-model="form.title"
              type="text"
              id="title"
              class="w-full border rounded p-2"
              required
            />
          </div>
  
          <!-- Description -->
          <div class="mb-4">
            <label for="description" class="block font-semibold mb-1">Description:</label>
            <textarea
              v-model="form.description"
              id="description"
              rows="5"
              class="w-full border rounded p-2"
              required
            ></textarea>
          </div>
  
          <!-- Category -->
          <div class="mb-4">
            <label for="category" class="block font-semibold mb-1">Category:</label>
            <select
              v-model="form.cat_id"
              id="category"
              class="w-full border rounded p-2"
              required
            >
              <option disabled value="">-- Select a category --</option>
              <option
                v-for="category in categories"
                :key="category.cat_id"
                :value="category.cat_id"
              >
                {{ category.name }}
              </option>
            </select>
          </div>
  
          <!-- Location -->
          <div class="mb-4">
            <label for="location" class="block font-semibold mb-1">Location:</label>
            <input
              v-model="form.location"
              type="text"
              id="location"
              class="w-full border rounded p-2"
              required
            />
          </div>
  
          <!-- Evidence Files -->
          <div class="mb-4">
            <label class="block font-semibold mb-1">Evidence (optional):</label>
  
            <input
              id="attachments"
              ref="fileInput"
              type="file"
              class="hidden"
              multiple
              @change="handleFileChange"
            />
  
            <label
              for="attachments"
              class="inline-block cursor-pointer rounded bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 select-none"
            >
              Choose Files
            </label>
  
            <div v-if="selectedFiles.length" class="mt-2 text-sm text-gray-700">
              <ul>
                <li v-for="(file, index) in selectedFiles" :key="index">
                  {{ file.name }}
                </li>
              </ul>
            </div>
          </div>
  
          <button
            type="submit"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
            :disabled="form.processing"
          >
            Submit Report
          </button>
        </form>
      </div>
    </AppLayout>
  </template>
  
  <script setup>
  import AppLayout from '@/layouts/AppLayout.vue';
  import { useForm } from '@inertiajs/vue3';
  import Swal from 'sweetalert2';
  import { ref } from 'vue';
  
  const props = defineProps({
    success: String,
    categories: Array
  });
  
  const fileInput = ref(null);
  const selectedFiles = ref([]);
  
  const form = useForm({
    title: '',
    description: '',
    cat_id: '',
    location: '',
    attachments: []
  });
  
  function handleFileChange(event) {
    selectedFiles.value = Array.from(event.target.files);
  }
  
  async function submitReport() {
    const result = await Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, submit it!'
    });
  
    if (result.isConfirmed) {
      // Create FormData manually to handle multiple files
      const data = new FormData();
      data.append('title', form.title);
      data.append('description', form.description);
      data.append('cat_id', form.cat_id);
      data.append('location', form.location);
  
      selectedFiles.value.forEach((file, index) => {
        data.append(`attachments[${index}]`, file);
      });
  
      form.post(route('report.store'), {
        data,
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => {
          Swal.fire('Submitted!', 'Your report has been submitted successfully.', 'success');
          form.reset();
          selectedFiles.value = [];
          if (fileInput.value) fileInput.value.value = null;
        },
        onError: () => {
          Swal.fire('Error!', 'There was an issue submitting your report.', 'error');
        }
      });
    }
  }
  </script>
  