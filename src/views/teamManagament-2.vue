<template>
  <div class="row mt-2">
    <div class="col-md-12 mb-2">
      <h3>Gestão de Equipe</h3>
    </div>
    <div class="col-md-4">
      <div
        class="btn-group"
        role="group"
        aria-label="Basic radio toggle button group"
      >
        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" v-model="seletedView" value="all" checked/>
        <label class="btn btn-outline-primary" for="btnradio1"
          ><i class="fa-solid fa-list-check me-1"></i> Todos</label
        >

        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" v-model="seletedView" value="notreaded"/>
        <label class="btn btn-outline-primary" for="btnradio2"
          ><i class="fa-solid fa-exclamation me-1"></i> Nao Lidos</label>

        <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" v-model="seletedView" value="readed"/>
        <label class="btn btn-outline-primary" for="btnradio3"
          ><i class="fa-solid fa-check me-1"></i> Lidos</label
        >
      </div>
    </div>

    <div class="col-md-4">
      <!-- <inputs
        input-type="search"
        pholder="Procurar comunicado"
        icon="fa-solid fa-magnifying-glass"
        class="w-100 mt-1"
      /> -->

      <input type="search" name="" class="form-control " placeholder="Pesquisa tarefa" v-model="search" id="">
    </div>
    <div class="col-md-4 mb-2">
      <div class="d-flex justify-content-end">
        <btn
          btn-type="button"
          name="Criar Tarefa"
          icon="fa-solid fa-plus me-1"
          class="w-75"
          data-bs-toggle="modal"
          data-bs-target="#staticBackdrop"
        />
      </div>
    </div>

    <div class="col-md-9 py-2" id="box-2">
      
      <ttm class="w-100" 
      :tasks="filteredTaskList " 
      @task-deleted="handleTaskDeleted"
      
      />
    </div>
    <div class="col-md-3 mt-2">
      <div class="div rounded" id="box">
        <h5 class="text-center">Sua equipe</h5>
        <hr />
        <div class="d-flex flex-column gap-2 justify-content-center">
          <div v-for="member in members" :key="member.id_utilizador" class="d-flex gap-2 align-items-center ps-3 pb-2" id="item">
            <img src="/img/cat.jpg" width="30px" height="30px" class="rounded-circle" alt=""/>
            <span class="fw-semibold">{{ member.nome }}</span>
          </div>
          <!-- <div class="d-flex gap-2 align-items-center ps-3 pb-2" id="item">
            <img src="/img/cat.jpg" width="30px" height="30px" class="rounded-circle" alt=""/>
            <span class="fw-semibold">Raul Shelton</span>
          </div> -->
        </div>
      </div>
    </div>
    <modal-tarefa />
  </div>
</template>

<script setup>
import btn from "../components/btn.vue";
import ttm from "../components/tables/tableTaskTeamManager.vue";
import inputs from "../components/inputs/input.vue";
import modalTarefa from "../components/modals/modalTarefa.vue";
import { ref, onMounted, computed } from "vue";
import axios from "axios";

const tasks = ref([]);
const members = ref([]);
const user = ref(null);

const search = ref('');
const seletedView = ref('all');

const handleTaskDeleted = (deletedTaskId) => {
  tasks.value = tasks.value.filter(task => task.id_tarefa !== deletedTaskId);
};

onMounted(async () => {
  const storedUser = sessionStorage.getItem('user');
  if (storedUser) {
    user.value = JSON.parse(storedUser);
    console.log(user.value)
  }

  try {
    const response = await axios.get(
      `http://localhost/gestaoDeTarefas-master/src/backend/controllers/listManagerC.php?id_user=${user.value.id_utilizador}`
    );
    if (response.data.success) {
      tasks.value = response.data.tasks;
      members.value = response.data.members;
    }
  } catch (error) {
    console.error("Erro ao buscar tarefas:", error);
  }

  console.log(filteredTaskList)
});

const filteredTaskList = computed(() => {
  // Verifica se a pesquisa está definida e é uma string
  const searchTerm = search.value ? search.value.toString() : '';

  // Objeto para agrupar tarefas por referência
  const groupedTasks = {};

  tasks.value.forEach(task => {
    // Verifica se a referência já existe no objeto agrupado
    if (!groupedTasks[task.referencia]) {
      groupedTasks[task.referencia] = {
        referencia: task.referencia,
        titulo: task.titulo,
        dataHora_Esperadaexecucao: task.dataHora_Esperadaexecucao,
        nivel_prioridade: task.nivel_prioridade,
        detalhes: task.detalhes,
        local_execucao: task.local_execucao,
        estado_tarefa: task.estado_tarefa,
        view: task.view,
        associados: [] // Aqui vamos agrupar os usuários
      };
    }

    // Adiciona o usuário à lista de associados para essa referência
    groupedTasks[task.referencia].associados.push({
      nome: task.nome,
      email: task.email,
      numero_celular: task.numero_celular,
      perfil: task.perfil
    });
  });

  // Converte o objeto agrupado em uma lista
  const groupedTaskList = Object.values(groupedTasks);

  // Aplica os filtros de busca e estado
  return groupedTaskList.filter(task => {
    const matchesSearch = searchTerm.length === 0 || 
                          task.titulo.toLowerCase().includes(searchTerm.toLowerCase());

    const matchesCheck = (seletedView.value === 'all') || 
                         (seletedView.value === 'notreaded' && task.view == 0) || 
                         (seletedView.value === 'readed' && task.view == 1);

    return matchesSearch && matchesCheck;
  });
});

</script>

<style scoped>
#box {
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.35);
}

#box-2 {
  height: 78vh;
  overflow-y: auto;
  scrollbar-width: thin;
}

#item {
  border-bottom: 1px solid rgb(202, 201, 201);
}

#item:last-child {
  border-bottom: none;
}

</style>