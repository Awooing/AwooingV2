<template>
  <div id="app">
    <Header :title="this.title" />

    <div class="awoo-container">
      <router-view />
    </div>

    <Footer />
  </div>
</template>

<script>
import Header from "@/components/Header";
import Footer from "@/components/Footer";

// css
import "./assets/css/argon.css";
import "./assets/css/awoo.css";
import "./assets/css/fonts.css";

// js
import "sweetalert2";
import "flatpickr";

export default {
  name: "App",
  components: {
    Footer,
    Header
  },
  data() {
    return {
      title: "Home"
    };
  },
  mounted(){
    if (this.$route.name !== "Article") {
      document.title = this.$route.name + " – Awooing.moe"
    }
    this.title = this.$route.name;
  },
  watch:{
    $route (to) {
      if (to.name !== "Article") {
        document.title = to.name + " – Awooing.moe"
      }
      this.title = to.name;
    }
  } 
};
</script>
