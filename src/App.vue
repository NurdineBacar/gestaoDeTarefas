<script setup>
import { RouterLink, RouterView, useRoute } from 'vue-router'
import sidebar from "./components/sidebar.vue";


const route= useRoute()
;</script>

<template>
  <div class="container-fluid">
    <div class="row py-2 ">
      <div class="col-md-auto" v-if="route.name !== '/'">
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
