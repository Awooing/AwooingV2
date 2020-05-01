<template>
  <div id="app">

    <div class="awoo-container">

      <router-view/>

    </div>

    <Footer/>
  </div>

</template>

<script>
import Footer from "@/components/Footer"

// css
import './assets/css/argon.css';
import './assets/css/awoo.css';
import './assets/css/fonts.css';

// js
import 'sweetalert2';
import 'flatpickr';

export default {
  name: 'App',
  components: {
    Footer
  },
  mounted() {

  }
}
</script>
