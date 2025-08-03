<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
//import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  });
};
</script>

<template>
  <Head title="Login" />
  <AppLayout>
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
          <div class="card shadow-sm">
            <div class="card-body p-4">
              <div class="text-center mb-4">
                <h3 class="card-title mb-4 text-center">Log in to your account</h3>
              </div>
              

              <form @submit.prevent="submit" novalidate>
                <!-- Email -->
                <div class="mb-3">
                  <label for="email" class="form-label">Email address</label>
                  <input
                    type="email"
                    id="email"
                    class="form-control"
                    v-model="form.email"
                    required
                    placeholder="email@example.com"
                    :class="{ 'is-invalid': form.errors.email }"
                  />
                  <div class="invalid-feedback">{{ form.errors.email }}</div>
                </div>

                <!-- Password -->
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input
                    type="password"
                    id="password"
                    class="form-control"
                    v-model="form.password"
                    required
                    placeholder="Password"
                    :class="{ 'is-invalid': form.errors.password }"
                  />
                  <div class="invalid-feedback">{{ form.errors.password }}</div>
                </div>

                <!-- Remember Me -->
                <div class="mb-3 form-check">
                  <input
                    type="checkbox"
                    id="remember"
                    class="form-check-input"
                    v-model="form.remember"
                  />
                  <label class="form-check-label" for="remember">Remember me</label>
                </div>

                <!-- Submit Button -->
                <button
                  type="submit"
                  class="btn btn-primary w-100"
                  :disabled="form.processing"
                >
                  <span v-if="form.processing" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                  Log in
                </button>
              </form>

              
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
