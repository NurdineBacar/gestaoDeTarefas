<template>
    <div class="row mt-2">
        <div class="col-md-12 mb-2">
            <h3>Tarefas</h3>
        </div>

        <div class="col-md-4 ">
            <inputs input-type="search" pholder="Procurar comunicado" icon="fa-solid fa-magnifying-glass" class="w-100 mt-1"/>
        </div>
        <div class="col-md-4">
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
          <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked/>
          <label class="btn btn-outline-primary" for="btnradio1"><i class="fa-solid fa-home me-1"></i> Pendentes</label>
  
          <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off"/>
          <label class="btn btn-outline-primary" for="btnradio2"><i class="fa-solid fa-home me-1"></i> Concluidas</label>
  
        </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="d-flex justify-content-end">
                <btn btn-type="button" name="Criar Tarefa" icon="fa-solid fa-plus me-1" class="w-75" data-bs-toggle="modal" data-bs-target="#staticBackdrop"/>
            </div>
        </div>

        <div class="col-md-12 mt-2">
            <tableTasks/>
        </div>
        <modalTask/>
    </div>
</template>

<script setup>
import btn from "../components/btn.vue";
import inputs from "../components/inputs/input.vue";
import tableTasks from "../components/tables/tableTasks.vue";
import modalTask from "../components/modals/modalTarefa.vue";
import { ref } from "vue";

</script>

<style scoped>

</style>