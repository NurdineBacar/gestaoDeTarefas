<script setup>
import circleChart from "../components/charts/circleChart.vue";
import itemChart from "../components/itemChart.vue";
import tHome from "../components/tables/tableHome.vue";
import modal from "../components/modals/modalTarefa.vue";
import modalTeam from "../components/modals/modalTeam.vue";
import modalAddTeam from "../components/modals/modalAddTeam.vue";
import { ref } from "vue";

let labels = ref(["Activos", "Nao Activos"]);
</script>

<template>
  <main class="row mt-2 px-2">
    <h3>Painel</h3>
    <div class="col-md-12 mt-2">
      <div class="row gap-1">
        <div class="col-md">
          <itemChart titulo="Colaboradores" val="300" :lbs="labels" />
        </div>
        <div class="col-md">
          <itemChart titulo="Colaboradores" val="200" :lbs="labels" />
        </div>
        <div class="col-md">
          <itemChart titulo="Colaboradores" val="200" :lbs="labels" />
        </div>
        <div class="col-md">
          <itemChart titulo="Colaboradores" val="200" :lbs="labels" />
        </div>
        <div class="col-md-3">
          <button class="btn btn-primary w-100 mb-3"  data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-plus me-2"></i> Tarefa</button>
          <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalTeam"><i class="fa-solid fa-plus me-2"></i> Equipe</button>
        </div>
      </div>
    </div>

    <div class="col-md-12 mt-3 rounded bg-white pt-2" id="tb">
      <tHome/>
    </div>
    <modal/>
    <modalTeam/>
  <modalAddTeam/>
  </main>
</template>

<style scoped>
.btn{
  height: 80px;
  font-size: 18px;
  font-weight: 600;
}


#tb{
  height: 55vh;
  overflow-y: auto;
  scrollbar-width: thin;
  scrollbar-color: transparent transparent;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
}
</style>
