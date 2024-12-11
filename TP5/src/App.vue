<template>
  <div>
    <Header/>
    <main>
      <router-view/>
    </main>
    <Footer/>
  </div>
</template>

<script setup>

import Header from './components/HeaderPage.vue';
import Footer from './components/FooterPage.vue';


</script>



