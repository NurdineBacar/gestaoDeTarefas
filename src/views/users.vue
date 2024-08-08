<template>
    <div class="row mt-2">
      <div class="col-md-12">
        <h3>Colaboadores</h3>
      </div>
      <div class="col-md-8">
        <div class="d-flex gap-3 align-items-center">
          <inputs input-type="search" pholder="Procurar colaborador" icon="fa-solid fa-magnifying-glass" class="w-50"/>
          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
          <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked/>
          <label class="btn btn-outline-primary" for="btnradio1"><i class="fa-regular fa-clone me-1"></i> Todos</label>
  
          <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off"/>
          <label class="btn btn-outline-primary" for="btnradio2"><i class="fa-solid fa-user-tie me-1"></i> Gestor</label>
  
          <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off"/>
          <label class="btn btn-outline-primary" for="btnradio3"><i class="fa-solid fa-user me-1"></i> Normal</label>
        </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="d-flex justify-content-end">
          <btn btn-type="button" name="Novo Colaborador" icon="fa-solid fa-user-plus me-2" class=""/>
        </div>
      </div>
      <div class="col-md-12 mt-2 p-2" id="box">
        <users />
      </div>
  
    </div>
  </template>
  
  <script setup>
  import inputs from "../components/inputs/input.vue";
  import users from "../components/tables/tableUsers.vue";
  import btn from "../components/btn.vue";
  </script>
  
  <style scoped>
  #box{
      height: 71vh;
      overflow-y: auto;
      scrollbar-width: thin;
  }
  </style>