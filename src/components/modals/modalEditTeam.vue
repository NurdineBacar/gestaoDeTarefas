<template>
    <div class="modal fade" id="modalEditTeam" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">
              <i class="fa-solid fa-users-gear me-2"></i>Editar Equipe
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row px-2">
              <div class="col-md-12 mb-2">
                <label for="" class="me-2 mb-2 fw-semibold">Nome da Equipe</label>
                <input type="text" v-model="nome_equipe" class="w-100"  />
  
                
              </div>
  
              
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary fw-semibold" @click="editarEquipe">
              <i class="fa-solid fa-users-gear me-1"></i>Editar Equipe
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted, watch } from 'vue';
  import axios from 'axios';

  
  const props = defineProps({
    idEquipe: Number, 
    nomeEquipe: String,
  });
  
  
  const idEquipeVar = ref(props.idEquipe);
  const nome_equipe = ref('');
 
  watch(() => props.nomeEquipe, (newNomeEquipe) => {
    nome_equipe.value = newNomeEquipe;
  });
  watch(() => props.idEquipe, (newIdEquipe) => {
    idEquipeVar.value = newIdEquipe;
  });
  
  const editarEquipe = async () => {
  try {
    // Define os dados a serem enviados para o PHP
    const data = {
      nome_equipe: nome_equipe.value,
      idEquipe: idEquipeVar.value
    };

    // Faz a requisição POST para o PHP
    const response = await axios.post('http://localhost/gestaoDeTarefas-master/src/backend/controllers/editTeam.php', data);

    // Verifica a resposta do servidor
    if (response.data.success) {
      alert('Dados atualizados com sucesso.');
      window.location.reload();
    } else {
      alert(`Erro: ${response.data.message}`);
    }
  } catch (error) {
    console.error('Erro ao editar equipe:', error);
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
