<script setup>
import { RouterLink, RouterView } from 'vue-router'
import sidebar from "./components/sidebar.vue";
</script>

<template>
  <div class="container-fluid">
    <div class="row py-2 ">
      <div class="col-md-auto">
          <sidebar/>
      </div>
      <div class="col-md">
        <router-view/>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
