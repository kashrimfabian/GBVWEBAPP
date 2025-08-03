<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  email: '',
  password: '',
});

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  });
};
</script>

<template>
  
  <div class="bg-light min-vh-100 d-flex align-items-center justify-content-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

          <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-5">

              <!-- Heading -->
              <div class="text-center mb-4">
                <h2 class="fw-bold text-primary">Log in to your account</h2>
                <p class="text-muted small">Welcome back! Please enter your credentials</p>
              </div>

              <!-- Login Form -->
              <form @submit.prevent="submit" novalidate>
                
                <!-- Email -->
                <div class="mb-4">
                  <label for="email" class="form-label fw-semibold">Email address</label>
                  <input
                    type="email"
                    id="email"
                    class="form-control form-control-lg"
                    v-model="form.email"
                    required
                    placeholder="name@example.com"
                    :class="{ 'is-invalid': form.errors.email }"
                    autocomplete="email"
                    autofocus
                  />
                  <div class="invalid-feedback">{{ form.errors.email }}</div>
                </div>

                <!-- Password -->
                <div class="mb-4">
                  <label for="password" class="form-label fw-semibold">Password</label>
                  <input
                    type="password"
                    id="password"
                    class="form-control form-control-lg"
                    v-model="form.password"
                    required
                    placeholder="Enter your password"
                    :class="{ 'is-invalid': form.errors.password }"
                    autocomplete="current-password"
                  />
                  <div class="invalid-feedback">{{ form.errors.password }}</div>
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                  <button
                    type="submit"
                    class="btn btn-primary btn-lg shadow-sm"
                    :disabled="form.processing"
                  >
                    <span
                      v-if="form.processing"
                      class="spinner-border spinner-border-sm me-2"
                      role="status"
                      aria-hidden="true"
                    ></span>
                    Log in
                  </button>
                </div>
              </form>

            </div>
          </div>

          <!-- Footer -->
          <div class="text-center mt-3 text-muted">
            &copy; {{ new Date().getFullYear() }} GBV
          </div>

        </div>
      </div>
    </div>
  </div>
</template>
