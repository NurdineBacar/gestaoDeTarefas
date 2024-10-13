<template>
  <div class="row mt-2">
    <div class="col-md-12">
      <h3>Reclamacoes</h3>
    </div>
    <div class="col-md-7">
      <div class="d-flex gap-3 align-items-center">
        <inputs
          input-type="search"
          pholder="Procurar reclamacao"
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
    <div class="col-md ">
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
      <tableComplaint />
    </div>

  </div>
</template>

<script setup>
import inputs from "../components/inputs/input.vue";
import tableComplaint from "../components/tables/tableComplaint.vue";
import btn from "../components/btn.vue";
import { ref, onMounted } from "vue";
import axios from "axios";

const complaints = ref([]);


onMounted(async () => {
  try {
    const response = await fetch(
      `http://localhost/gestaoDeTarefas-master/src/backend/controllers/listComplaint.php`
    );
    if (response.data.success) {
      complaints.value = response.data.data;
      console.log(complaints.value)
    }
  } catch (error) {
    console.error("Erro ao buscar tarefas:", error);
  }
});
</script>

<style scoped>
#box{
    height: 71vh;
    overflow-y: auto;
    scrollbar-width: thin;
}
</style>