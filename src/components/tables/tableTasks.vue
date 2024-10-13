<template>
  <table class="rounded">
    <thead>
      <tr>
        <th><input type="checkbox" name="" id="" /></th>
        <th></th>
        <th>Titulo</th>
        <th>Nivel de Prioridade</th>
        <th>Responsavel</th>
        <th>Data</th>
        <th>Estado</th>
        <th></th>
      </tr>
    </thead>

    <tbody>
      <tr v-for="task in filteredTaskList" :key="task.id_tarefa">
        <th><input type="checkbox" name="" id="" /></th>
        <td class="fs-6"><span class="badge bg-primary">Nova!</span></td>
        <td class="fw-semibold">{{ task.titulo }}</td>
        <td>
          <span class="badge bg-danger">{{ task.nivel_prioridade }}</span>
        </td>
        <td>
          <div class="d-flex gap-2 justify-content-center align-items-center position-relative" >
            <img
              src="/img/do-utilizador.png"
              width="30px"
              height="30px"
              class="rounded-circle"
              alt="user-img"
            />
            <img
              src="/img/do-utilizador.png"
              width="33px"
              height="33px"
              class="rounded-circle"
              alt="user-img"
              id="listUser"
              v-show="task.associados.length>1"
            />
            <span :class="task.associados.length>1? 'ms-3': ''">
              {{ task.associados.length>1?  'Usuarios: +'+task.associados.length: task.associados[0].nome }}
            </span>
          </div>
        </td>
        <td>{{ formatDate(task.dataHora_Esperadaexecucao) }}</td>
        <td>
          <span class="badge bg-warning">{{ task.estado_tarefa }}</span>
        </td>
        <td>
          <div class="d-flex gap-3">
            <a data-bs-toggle="modal" data-bs-target="#modalView-1" @click.prevent="handleTask(task)">
              <i class="fa-solid fa-arrow-up-right-from-square fs-5"></i>
            </a>
            <a href="#" @click.prevent="deleteTask(task.referencia)">
              <i class="fa-solid fa-trash fs-5"></i>
            </a>
          </div>
          
        </td>
      </tr>
      <mview :data="selectedTask" />
    </tbody>
  </table>
</template>

<script setup>
import { ref, onMounted, defineProps, computed } from "vue";
import mview from "../modals/viewTasksT.vue"; // Import do modal
import axios from "axios";

const taskList = ref([]);
const selectedTask = ref(null);

const props = defineProps(['search','check']);

// Função para buscar a lista de tarefas
onMounted(async () => {
  try {
    const response = await axios.get('http://localhost/gestaoDeTarefas-master/src/backend/controllers/listTasks.php');
    const json = response.data;
    if (json.success) {
      taskList.value = json.data;
      console.log(taskList.value)
    } else {
      console.error('Erro na resposta:', json.message);
    }
  } catch (error) {
    console.log('Erro ao buscar dados:', error);
  }

  console.log(filteredTaskList)
});



// Filtrar tarefas com base na pesquisa e no estado selecionado
onMounted(async () => {
  try {
    const response = await axios.get('http://localhost/gestaoDeTarefas-master/src/backend/controllers/listTasks.php');
    const json = response.data;
    if (json.success) {
      taskList.value = json.data;
      console.log(taskList.value);
    } else {
      console.error('Erro na resposta:', json.message);
    }
  } catch (error) {
    console.log('Erro ao buscar dados:', error);
  }
});

const filteredTaskList = computed(() => {
  // Objeto para agrupar tarefas por referência
  const groupedTasks = {};

  taskList.value.forEach(task => {
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
    const matchesSearch = props.search.length === 0 || 
                          task.titulo.toLowerCase().includes(props.search.toLowerCase());

    const matchesCheck = (props.check === 'all') || 
                         (props.check === 'pending' && task.estado_tarefa === 'pendente') || 
                         (props.check === 'done' && task.estado_tarefa === 'concluido');

    return matchesSearch && matchesCheck;
  });
});


// Função para selecionar uma tarefa para exibição no modal
const handleTask = (task) => {
  selectedTask.value = task;
  console.log("Tarefa selecionada:", task);
};

// Função para deletar tarefa
const deleteTask = async (id) => {
  if (!confirm("Tem certeza que deseja deletar esta tarefa?")) {
    return;
  }

  try {
    const response = await axios.post(
      "http://localhost/gestaoDeTarefas-master/src/backend/controllers/deleteTask.php",
      { id: id },
      {
        headers: {
          "Content-Type": "application/json"
        }
      }
    );

    const json = response.data;

    if (json.success) {
      // Atualizando a lista de tarefas após exclusão
      taskList.value = taskList.value.filter(task => task.id_tarefa !== id);
      alert("Tarefa deletada com sucesso!");
    } else {
      console.error("Erro na resposta:", json.message);
      alert("Erro ao deletar tarefa: " + json.message);
    }
  } catch (error) {
    console.error("Erro ao excluir a tarefa:", error);
    alert("Erro ao excluir a tarefa.");
  }
};

// Função para formatar a data
const formatDate = (dateString) => {
  const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
  const date = new Date(dateString);
  return date.toLocaleDateString('pt-BR', options);
};
</script>

<style scoped>
table {
  width: 100%;
  background: white;
  box-shadow: 0 0 7px rgba(0, 0, 0, 0.4);
  border-collapse: collapse;
}

th,
td {
  padding: 10px 0;
  padding-left: 10px;
  text-align: center;
  font-size: 14px;
}

thead tr,
tbody tr {
  border-bottom: 1px solid rgb(202, 201, 201);
}

tbody tr:last-child {
  border: none;
}

a {
  text-decoration: none;
}

#listUser {
  position: absolute;
  left: 45px;
  border: 1px solid white;
}
</style>
