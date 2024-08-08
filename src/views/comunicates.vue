<template>
    <div class="row mt-2">
      <div class="col-md-12">
        <h3>Comunicados</h3>
      </div>
      <div class="col-md-7">
        <div class="d-flex gap-3 align-items-center">
          <inputs
            input-type="search"
            pholder="Procurar comunicado"
            icon="fa-solid fa-magnifying-glass"
            class="w-100"
          />
          <div class="d-flex align-items-center gap-1">
            <span class="fw-bold">Data</span>
            <inputs input-type="date" icon="" class="w-75" />
            <btn btn-type="button" name="Procurar" />
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="d-flex justify-content-end">
          <btn
            btn-type="button"
            name="Novo"
            icon="fa-solid fa-plus me-1"
            class="w-50"
          />
        </div>
      </div>
      <div class="col-md mt-3">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
          <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked/>
          <label class="btn btn-outline-primary" for="btnradio1"><i class="fa-solid fa-home me-1"></i> Todos</label>
  
          <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off"/>
          <label class="btn btn-outline-primary" for="btnradio2"><i class="fa-solid fa-home me-1"></i> Nao Lidos</label>
  
          <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off"/>
          <label class="btn btn-outline-primary" for="btnradio3"><i class="fa-solid fa-home me-1"></i> Lidos</label>
        </div>
      </div>
      <div class="col-md-12 mt-2 p-2" id="box">
        <tableComunicates />
      </div>
  
    </div>
  </template>
  
  <script setup>
  import inputs from "../components/inputs/input.vue";
  import tableComunicates from "../components/tables/tableComunicates.vue";
  import btn from "../components/btn.vue";
  </script>
  
  <style scoped>
  #box{
      height: 71vh;
      overflow-y: auto;
      scrollbar-width: thin;
  }
  </style>