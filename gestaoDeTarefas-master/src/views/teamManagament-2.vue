<template>
    <div class="row mt-2">
        <div class="col-md-12 mb-2">
            <h3>GEstao de Equipe 2</h3>
        </div>
        <div class="col-md-4">
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
          <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked/>
          <label class="btn btn-outline-primary" for="btnradio1"><i class="fa-solid fa-home me-1"></i> Todos</label>
  
          <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off"/>
          <label class="btn btn-outline-primary" for="btnradio2"><i class="fa-solid fa-home me-1"></i> Nao Lidos</label>
  
          <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off"/>
          <label class="btn btn-outline-primary" for="btnradio3"><i class="fa-solid fa-home me-1"></i> Lidos</label>
        </div>
        </div>

        <div class="col-md-4 ">
            <inputs input-type="search" pholder="Procurar comunicado" icon="fa-solid fa-magnifying-glass" class="w-100 mt-1"/>
        </div>
        <div class="col-md-4 mb-2">
            <div class="d-flex justify-content-end">
                <btn btn-type="button" name="Criar Tarefa" icon="fa-solid fa-plus me-1" class="w-75"  data-bs-toggle="modal" data-bs-target="#staticBackdrop"/>
            </div>
        </div>

        <div class="col-md-9 py-2" id="box-2">
            <ttm class="w-100"/>
        </div>
        <div class="col-md-3 mt-2">
            <div class="div rounded" id="box">
                <h5 class="text-center">Sua equipe</h5>
                <hr>
                <div class="d-flex flex-column gap-2 justify-content-center">
                    <div class="d-flex gap-2 align-items-center ps-3 pb-2" id="item">
                        <img src="/img/cat.jpg" width="30px" height="30px" class="rounded-circle" alt="">
                        <span class="fw-semibold">Raul Shelton</span>
                    </div>
                    <div class="d-flex gap-2 align-items-center ps-3 pb-2" id="item">
                        <img src="/img/cat.jpg" width="30px" height="30px" class="rounded-circle" alt="">
                        <span class="fw-semibold">Raul Shelton</span>
                    </div>
                    <div class="d-flex gap-2 align-items-center ps-3 pb-2" id="item">
                        <img src="/img/cat.jpg" width="30px" height="30px" class="rounded-circle" alt="">
                        <span class="fw-semibold">Raul Shelton</span>
                    </div>
                    <div class="d-flex gap-2 align-items-center ps-3 pb-2" id="item">
                        <img src="/img/cat.jpg" width="30px" height="30px" class="rounded-circle" alt="">
                        <span class="fw-semibold">Raul Shelton yassser Antonio</span>
                    </div>
                </div>
            </div>
        </div>
        <modal-tarefa/>

    </div>
</template>

<script setup>
    import btn from "../components/btn.vue";
    import ttm from "../components/tables/tableTaskTeamManager.vue";
    import inputs from "../components/inputs/input.vue";
    import modalTarefa from "../components/modals/modalTarefa.vue";
    import { ref } from "vue";
</script>

<style scoped>
    #box{
        box-shadow: 0 0 5px rgba(0, 0, 0, .35);
    }

    #box-2{
        height: 78vh; 
        overflow-y: auto;
        scrollbar-width: thin;
    }
    
    #item{
        border-bottom: 1px solid rgb(202, 201, 201);
    }

    #item:last-child{
        border-bottom: none;
    }
</style>