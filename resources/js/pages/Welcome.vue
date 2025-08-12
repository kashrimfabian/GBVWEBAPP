
<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
</script>

<template>
    <AppLayout>
        <div class="container pt-5 pb-5 text-center">
          <h1 class="display-4 font-weight-bold mb-3">Welcome to the GBV Tracking System</h1>
          <p class="lead mb-4">
            Empowering communities to report, track, and respond to gender-based violence effectively and confidentially.
          </p>
          <a href="/login" class="btn btn-primary btn-lg">Get Started</a>
        </div>
  
        <!-- About -->
        <div id="about" class="container py-5">
          <h2 class="text-center mb-4">About This Platform</h2>
          <p class="text-center">
            Our platform allows victims, community workers, and authorities to collaborate in fighting GBV through timely reporting,
            case management, and secure communication.
          </p>
        </div>
  
        <!-- Features -->
        <div id="features" class="container py-5">
          <h2 class="text-center mb-4">Key Features</h2>
          <div class="row text-center">
            <div class="col-md-4">
              <i class="fas fa-shield-alt fa-3x text-primary mb-2"></i>
              <h5>Secure Reporting</h5>
              <p>Confidential channels for submitting GBV cases safely.</p>
            </div>
            <div class="col-md-4">
              <i class="fas fa-chart-line fa-3x text-primary mb-2"></i>
              <h5>Data Analytics</h5>
              <p>Visualize trends and patterns to enable proactive response.</p>
            </div>
            <div class="col-md-4">
              <i class="fas fa-users fa-3x text-primary mb-2"></i>
              <h5>Stakeholder Access</h5>
              <p>Role-based access for health workers, legal staff, and community leaders.</p>
            </div>
          </div>
        </div>
    </AppLayout>
</template>
