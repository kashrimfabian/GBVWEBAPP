<script setup>
import { router, Link, usePage } from '@inertiajs/vue3';

const page = usePage();

function logout() {
  router.post(route('logout'));
}
</script>

<template>
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-bars"></i>
          </a>
        </li>
      </ul>

      <!-- Right -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <button
            type="button"
            @click.prevent="logout"
            class="btn btn-link nav-link"
            style="padding: 0; border: none; background: none;"
          >
            <i class="fas fa-sign-out-alt"></i> Logout
          </button>
        </li>
      </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <Link href="/" class="brand-link">
        <img src="/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8" />
        <span class="brand-text font-weight-light">GBV</span>
      </Link>

      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="icon text-white mr-2">
            <i class="fas fa-user-circle fa-2x"></i>
          </div>
          <div class="info">
            <span class="d-block">
              {{ page.props.auth?.user?.name || 'Guest' }}
            </span>
          </div>
        </div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
            <li class="nav-item">
              <Link href="/dashboard" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </Link>
            </li>
            <li class="nav-item">
              <Link href="/roles" class="nav-link">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>Roles</p>
              </Link>
            </li>
            <li class="nav-item">
              <Link href="/users" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Users</p>
              </Link>
            </li>
            <li class="nav-item">
              <Link href="/categories" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>Categories</p>
              </Link>
            </li>
            <li class="nav-item">
              <Link :href="route('password.change')" class="nav-link">
                <i class="nav-icon fas fa-key"></i>
                <p>Change Password</p>
              </Link>
            </li>
            <li class="nav-item">
              <Link :href="route('report.index')" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>Reports</p>
              </Link>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <!-- Main content -->
    <div class="content-wrapper p-4">
      <slot />
    </div>

    <!-- Footer -->
    <footer class="main-footer">
      <strong>&copy; {{ new Date().getFullYear() }}
        <a href="https://adminlte.io">GBV</a>.
      </strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
      </div>
    </footer>
  </div>
</template>
