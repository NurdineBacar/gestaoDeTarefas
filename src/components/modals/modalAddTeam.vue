<template>
  <div class="modal fade" id="modalAddTeam" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">
            <i class="fa-solid fa-users-gear me-2"></i>Adicionar colaboradores à Equipe
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row px-2">
            <div class="col-md-12 mb-2">
              <label for="" class="me-2 mb-2 fw-semibold">Nome da Equipe</label>
              <input type="text" v-model="nome_equipe" class="w-100" readonly />

              
            </div>

            <div class="col-md-12">
              <label for="" class="me-2 mb-2 fw-semibold">Colaborador</label>
              <div class="d-flex gap-2">
                <select v-model="selecionado" class="custom-select" style="width: 100%;" @change="imprimirIds">
                  <option v-for="(gestorItem, index) in gestor" :key="index" :value="gestorItem.id_utilizador">
                    {{ gestorItem.nome }}
                  </option>
                </select>
                <btn btn-type="button" name="Adicionar" icon="" @click="adicionarItem" />
              </div>
            </div>
            <div class="col-md-12 mb-2" style="margin-top: 10px;">
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
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary fw-semibold" @click="adicionarColaboradores">
            <i class="fa-solid fa-users-gear me-1"></i>Adicionar Colaborador
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';
import btn from '../btn.vue';

const props = defineProps({
  idEquipe: Number, 
  nomeEquipe: String,
});


const idEquipeVar = ref(props.idEquipe);
const selecionado = ref('');
const nome_equipe = ref('');
const gestor = ref([]);
const items = ref([]);


watch(() => props.nomeEquipe, (newNomeEquipe) => {
  nome_equipe.value = newNomeEquipe;
});
watch(() => props.idEquipe, (newIdEquipe) => {
  idEquipeVar.value = newIdEquipe;
});



const pegarColaboradores = async () => {
  try {
    const response = await axios.get('http://localhost/gestaoDeTarefas-master/src/backend/controllers/selectColaborador.php');
    gestor.value = response.data.data || [];
  } catch (error) {
    console.error('Erro ao buscar colaboradores:', error);
  }
};

const adicionarItem = () => {
  const selected = gestor.value.find(gestorItem => gestorItem.id_utilizador === selecionado.value);
  if (selected) {
    const isDuplicate = items.value.some(item => item.id_utilizador === selected.id_utilizador);
    if (!isDuplicate) {
      items.value.push(selected);
    } else {
      console.warn('Este colaborador já foi adicionado.');
    }
  }
};

const removerItem = (index) => {
  items.value.splice(index, 1);
};

const adicionarColaboradores = async () => {
  try {
    console.log('ID da equipe:', idEquipeVar.value);
    for (let item of items.value) {
      const response = await axios.post('http://localhost/gestaoDeTarefas-master/src/backend/controllers/addMenbroEquipe.php', {
        id_equipe: idEquipeVar.value,
        id_utilizador: item.id_utilizador
      });

      if (response.data.success) {
        alert(`Colaborador ${item.nome} adicionado com sucesso! na equipe ${idEquipeVar.value}`);
        window.location.reload();
      } else {
        alert(`Erro ao adicionar colaborador ${item.nome}: ${response.data.message}`);
      }
    }
    items.value = [];
  } catch (error) {
    console.error('Erro ao adicionar colaboradores:', error);
  }
};

onMounted(() => {
  pegarColaboradores();
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
