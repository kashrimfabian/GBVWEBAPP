<script setup lang="ts">
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';

interface Category {
  cat_id: number;
  name: string;
}

interface Attachment {
  id: number;
  file_path: string;
  file_type: string;
  original_filename: string;
}

interface Report {
  reprt_id: number;
  title: string;
  description: string;
  location: string;
  created_at: string;
  category?: Category;
  attachments: Attachment[];
}

const props = defineProps<{ report: Report }>();
</script>

<template>
  <AdminLayout :title="`Report: ${report.title}`">
    <Head :title="`Report Details - ${report.title}`" />

    <div class="container my-4">
      <h2>{{ report.title }}</h2>
      <p><strong>Category:</strong> {{ report.category?.name || 'N/A' }}</p>
      <p><strong>Location:</strong> {{ report.location }}</p>
      <p><strong>Description:</strong> {{ report.description }}</p>
      <p><strong>Submitted On:</strong> {{ new Date(report.created_at).toLocaleString() }}</p>

      <hr />

      <h4>Attachment Evidences</h4>

      <div v-if="report.attachments.length === 0" class="text-muted">
        No attachments submitted with this report.
      </div>

      <div v-else class="d-flex flex-wrap gap-3">
        <template v-for="attachment in report.attachments" :key="attachment.id">
          <div v-if="attachment.file_type === 'image'" class="attachment-preview">
            <img
              :src="attachment.file_path"
              :alt="attachment.original_filename"
              style="max-width: 200px; max-height: 150px; border-radius: 6px;"
            />
            <p class="text-truncate" style="max-width: 200px;">{{ attachment.original_filename }}</p>
          </div>

          <div v-else-if="attachment.file_type === 'video'" class="attachment-preview">
            <video
              controls
              style="max-width: 300px; max-height: 200px; border-radius: 6px;"
            >
              <source :src="attachment.file_path" type="video/mp4" />
              Your browser does not support the video tag.
            </video>
            <p class="text-truncate" style="max-width: 300px;">{{ attachment.original_filename }}</p>
          </div>

          <div v-else-if="attachment.file_type === 'audio'" class="attachment-preview">
            <audio controls>
              <source :src="attachment.file_path" type="audio/mpeg" />
              Your browser does not support the audio element.
            </audio>
            <p class="text-truncate" style="max-width: 300px;">{{ attachment.original_filename }}</p>
          </div>

          <div v-else class="attachment-preview">
            <a :href="attachment.file_path" target="_blank" rel="noopener noreferrer">
              Download: {{ attachment.original_filename }}
            </a>
          </div>
        </template>
      </div>
    </div>
  </AdminLayout>
</template>
