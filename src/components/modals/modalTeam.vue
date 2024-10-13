<template>
  <div class="modal fade" id="modalTeam" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">
            <i class="fa-solid fa-users-gear me-2"></i>Criar Equipe
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row px-2">
            <div class="col-md-12 mb-2">
              <label for="" class="me-2 mb-2 fw-semibold">Nome da Equipe</label>
              <input v-model="nome_equipe" type="text" class="form-control" placeholder="Nome da Equipe" />
            </div>

              <!-- <div class="d-flex gap-2">
              <select v-model="selecionado" class="custom-select" style="width: 100%;">
            <option v-for="(prioridade, index) in prioridades" :key="index" :value="prioridade.id_utilizador">
              {{ prioridade.nome }}
            </option>
          </select>
          <btn btn-type="button" name="Adicionar" icon="" @click="adicionarItem"/>
        </div>  -->
         
            <!-- <div class="col-md-12 mb-2" style="margin-top: 10px;">
          <div class="d-flex gap-2 w-100 bg-secondary rounded p-2 flex-wrap" id="users">
            <span 
        v-for="(item, index) in items" 
        :key="index" 
        class="p-1 bg-primary text-white rounded"
        :data-id="item.id_utilizador"
      >
        {{ item.nome }}
        <a href="#" class="px-1 rounded bg-danger text-white" @click.prevent="removerItem(index)">
          <i class="fa-solid fa-xmark"></i>
        </a>
      </span>
          </div>
          </div> -->

            <div class="col-md-12">
              <label for="" class="me-2 mb-2 fw-semibold">Gestor</label>
              <div class="d-flex gap-2">
                <select v-model="selecionado" class="custom-select text-center form-control" style="width: 100%;">
                  <option value="">Selecione</option>
                  <option v-for="(gestorItem, index) in gestor" :key="index" :value="gestorItem.id_utilizador">
                    {{ gestorItem.nome }}
                  </option>
                </select>
                
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary fw-semibold" @click="criarEquipe">
            <i class="fa-solid fa-users-gear me-1"></i>Criar Equipe
          </button>
        </div>

        <button type="button" class="btn btn-primary fw-semibold" data-bs-toggle="modal" data-bs-target="#modalColaborador" style="margin: 10px 10px 10px 10px">
          <i class="fa-solid fa-users-gear me-1"></i>Manipular equipe
        </button>

       
      </div>
    </div>
    <modalAddTeam/>
  </div>
</template>

<script setup>
import { ref, onMounted, defineProps, toRefs  } from 'vue';
import axios from 'axios';
import btn from "../btn.vue";
import modalAddTeam from "./modalColaborador.vue";


const props = defineProps({
    user: Object
});


const selecionado = ref('');
const gestor = ref([]);
const nome_equipe = ref('');

// Função para buscar os dados da API
const pegarGestores = async () => {
  try {
    const response = await axios.get('http://localhost/gestaoDeTarefas-master/src/backend/controllers/selectGestor.php');
    console.log('Dados recebidos:', response.data.data);
    gestor.value = response.data.data;
  } catch (error) {
    console.error('Erro ao buscar gestor:', error);
  }
};

// Método para imprimir o ID do item selecionado
const imprimirIds = () => {
  console.log('ID selecionado:', selecionado.value);
};

onMounted(() => {
  pegarGestores();
});

// Função para criar a equipe
const criarEquipe = async () => {
  try {
    const response = await axios.post('http://localhost/gestaoDeTarefas-master/src/backend/controllers/addEquipe.php', {
      nome_equipe: nome_equipe.value,
      selecionado: selecionado.value
    });

    if (response.data.success) {
      alert('Equipe criada com sucesso!');
      nome_equipe.value = '';
    } else {
      alert('Erro ao adicionar Equipe: ' + response.data.message);
    }
  } catch (error) {
    console.error('Erro ao enviar a requisição:', error);
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





