<!-- TabelaTarefas.vue -->
<template>
  <div>
    <table class="table table-hover text-center">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Titulo</th>
          <th scope="col">Nivel de Prioridade</th>
          <th scope="col">Responsavel</th>
          <th scope="col">Data</th>
          <th scope="col">Estado</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="task in tasks" :key="task.id_tarefa">
          <td class="fs-6"><span class="badge bg-primary">Nova!</span></td>
          <td class="fw-bold text-capitalize">{{ task.titulo }}</td>
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
              <a href="#" @click.prevent="deleteTask(task.id_tarefa)">
                <i class="fa-solid fa-trash fs-5"></i>
              </a>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <mview :data="selectedTask" />
  </div>
</template>

<script setup>
import { ref } from "vue";
import mview from "../modals/viewTasksT.vue"; // Ajuste o caminho conforme necessário
import axios from "axios";

// Definindo as props
const props = defineProps({
  tasks: {
    type: Array,
    required: true
  },
  search: String,
  check: String,
});

// Emitindo eventos para o componente pai
const emit = defineEmits(["task-deleted"]);

// Estado local para a tarefa selecionada
const selectedTask = ref(null);

// Função para lidar com a seleção de uma tarefa
const handleTask = (task) => {
  selectedTask.value = task;
  console.log("Tarefa selecionada:", task);
};

// Função para deletar uma tarefa
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
      alert("Tarefa deletada com sucesso!");
      emit("task-deleted", id); // Emitindo o evento para o pai
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
  font-size: 13px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.35);
}

a {
  text-decoration: none;
}
#listUser {
  position: absolute;
  left: 20px;
  border: 1px solid white;
}
</style>
