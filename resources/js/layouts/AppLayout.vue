<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <div class="min-h-screen bg-gray-100 font-sans antialiased text-gray-900">

    <!-- Primary Navigation Header -->
    <header class="bg-white shadow-lg">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
          
          <!-- Logo -->
          <div class="flex-shrink-0 flex items-center">
            <Link :href="route('home')" class="font-bold text-2xl text-blue-600">
              GBV
            </Link>
          </div>

          <!-- Navigation Links -->
          <nav class="hidden sm:flex space-x-8">
            <!-- <Link :href="route('welcome')" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md font-medium transition duration-150 ease-in-out">
              Home
            </Link> -->
            <!-- <Link :href="route('report.create')" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md font-medium transition duration-150 ease-in-out">
              Anonymous Report
            </Link> -->
            <Link :href="route('login')" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md font-medium transition duration-150 ease-in-out">
              Login
            </Link>
          </nav>

        </div>
      </div>
    </header>

    <!-- Main Content Slot -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="bg-gray-200 text-center py-4 mt-6">
      <p class="text-gray-600 text-sm">&copy; {{ new Date().getFullYear() }} GBV</p>
    </footer>

  </div>
</template>
