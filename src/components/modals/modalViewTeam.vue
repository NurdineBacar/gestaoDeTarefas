<template>
    <div class="modal fade" id="modalViewTeam" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">
              <i class="fa-solid fa-users-gear me-2"></i> {{ nomeEquipe }}
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row px-2">
              <div class="col-md-12 mb-2">
                <label for="" class="me-2 mb-2 fw-semibold">Membros da {{ nomeEquipe }}</label>
                <!-- <span>ID da Equipe: {{ idEquipeVar }}</span> -->
              </div>
            </div>
          </div>
          <div class="col-md-12 mt-3 rounded bg-white pt-2" id="tb">
            <tTeamMenber :idEquipe="idEquipeVar"/>
          </div>  
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, watch } from 'vue';
  import tTeamMenber from "../tables/tableTeamMenbers.vue";
  
  const props = defineProps({
    idEquipe: Number, 
    nomeEquipe: String,
  });
  
  const idEquipeVar = ref(props.idEquipe);
  const nome_equipe = ref(props.nomeEquipe);
  
  watch(() => props.idEquipe, (newIdEquipe) => {
    idEquipeVar.value = newIdEquipe;
  });
  watch(() => props.nomeEquipe, (newNomeEquipe) => {
    nome_equipe.value = newNomeEquipe;
  });
  </script>
  
  <style scoped>
  #users {
    max-height: 100px;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: transparent transparent;
  }
  </style>
  