<script setup>
import circleChart from "../components/charts/circleChart.vue";
// import itemChart from "../components/itemChart.vue";
import item from "../components/item.vue";
import tHome from "../components/tables/tableHome.vue";
import modal from "../components/modals/modalTarefa.vue";
import modalTeam from "../components/modals/modalTeam.vue";
import modalAddTeam from "../components/modals/modalAddTeam.vue";
import { ref, defineProps, onMounted } from "vue";

const props = defineProps(['user']);

const utilizador = ref([]);
const reclamacao = ref([]);
const comunicacao = ref([]);
const tarefa = ref({ pendente: 0, concluida: 0 });
const labelUser = ref(["Activos"]);
const labeltasks = ref(["Concluidos", "Pendente"]);
const labelComunication = ref(["Realizadas"]);
const labelComplaint = ref(["Realizadas"]);
const tarefaPendente =ref(0);
const tarefaConcluida =ref(0);

onMounted(async () => {
  try {
    const response = await fetch('http://localhost/gestaoDeTarefas-master/src/backend/controllers/home.php', {
      method: 'GET',
    });

    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }

    const result = await response.json();

    if (result.success) {
      tarefa.value = result.tarefa;
      reclamacao.value = result.reclamacao;
      utilizador.value = result.utilizador;
      comunicacao.value = result.comunicacao;
     
      
    } else {
      console.error(result.message);
    }
  } catch (error) {
    console.error('Erro ao buscar dados:', error);
  }
});
</script>

<template>
  <main class="row mt-2 px-2">
    <h3>Painel</h3>
    <div class="col-md-12 mt-2">
      <div class="row gap-1">
        <div class="col-md">
          <item titulo="Usuarios" :val="utilizador.length" icon="fa-solid fa-users"/>
        </div>
        <div class="col-md">
          <item titulo="Tarefas" :val="tarefa.length" icon="fa-solid fa-list-check"   :pendente="tarefaPendente" :concluido="tarefaConcluida" />
        </div>
        <div class="col-md">
          <item titulo="Comunicações" :val="comunicacao.length" icon="fa-regular fa-comment-dots"/>
        </div>
        <div class="col-md">
          <item titulo="Reclamações" :val="reclamacao.length" icon="fa-solid fa-face-sad-tear"/>
        </div>
        <div class="col-md-3">
          <button class="btn btn-primary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="fa-solid fa-plus me-2"></i> Tarefa
          </button>
          <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalTeam" v-show="user.perfil != 'gestor'">
            <i class="fa-solid fa-plus me-2"></i> Equipe
          </button>
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
.btn {
  height: 80px;
  font-size: 18px;
  font-weight: 600;
}

#tb {
  height: 55vh;
  overflow-y: auto;
  scrollbar-width: thin;
  scrollbar-color: transparent transparent;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
}
</style>
