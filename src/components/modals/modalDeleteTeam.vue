<template>
    <div class="modal fade" id="modalDeleteTeam" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">
              <i class="fa-solid fa-users-gear me-2"></i> Eliminar
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row px-2">
              <div class="col-md-12 mb-2">
                <label for="" class="me-2 mb-2 fw-semibold center"> Tem certeza de deseja eliminar a <br>
                  {{ nomeEquipe }}</label>
                <!-- <span>ID da Equipe: {{ idEquipeVar }}</span> -->
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary fw-semibold" @click="eliminarEquipe">
              <i class="fa-solid fa-users-gear me-1"></i>Eliminar Equipe
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>
  

  <script setup>
  import { ref, watch } from 'vue';
  import axios from 'axios';
  
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
  
  const eliminarEquipe = async () => {
    try {
      const data = {
        idEquipe: idEquipeVar.value
      };
  
      const response = await axios.post('http://localhost/gestaoDeTarefas-master/src/backend/controllers/deleteTeam.php', data);
  
      if (response.data.success) {
        alert('Equipe eliminada com sucesso.');
        window.location.reload();
      } else {
        alert(`Erro: ${response.data.message}`);
      }
    } catch (error) {
      console.error('Erro ao eliminar a equipe:', error);
    }
  };
  </script>
  
  <style scoped>
  #users {
    max-height: 100px;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: transparent transparent;
  }
  </style>
  