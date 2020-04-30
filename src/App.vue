<template>
  <div id="app">

    <div class="awoo-container">
      <!-- ::Banner -->
      <div class="section section-hero section-shaped" id="awoo-banner">
        <div class="shape shape-style-1 shape-primary awoo-banner-gradient">
        </div>
        <div class="page-header">
          <div class="container shape-container d-flex align-items-center py-lg">
            <div class="col px-0">
              <!-- TODO: Changing Title -->
              <h1 class="welcome shadowed" style="margin:0;display: inline-block;">Title</h1>
            </div>
          </div>
        </div>
      </div>
      <Navigation/>
      <div class="container">
        <router-view/>
      </div>

    </div>

    <Footer/>
  </div>

</template>

<script>
import Navigation from "@/components/Navigation"
import Footer from "@/components/Footer"

// css
import './assets/css/argon.css';
import './assets/css/awoo.css';
import './assets/css/fonts.css';

// js
import 'jquery';
import 'sweetalert2';
import 'flatpickr';

export default {
  name: 'App',
  components: {
    Footer,
    Navigation
  }
}
</script>
