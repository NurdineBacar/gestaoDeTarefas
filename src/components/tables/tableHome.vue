<template>
  <div class="">
    <table class="table table-hover text-center">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Titulo</th>
          <th scope="col">Nivel de Prioridade</th>
          <th scope="col">Responsavel</th>
          <th scope="col">Data</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in data" :key="item.id_tarefa">
          <th scope="row">{{ item.referencia }}</th>
          <td class="fw-semibold">{{ item.titulo }}</td>
          <td>
            <span class="badge bg-danger">{{ item.nivel_prioridade }}</span>
          </td>
          <td>
            <div class="d-flex gap-2 justify-content-center align-items-center">
              
              <span>{{ item.Responsavel }}</span>
            </div>
          </td>
          <td>{{ item.dataHora_Esperadaexecucao }}</td>
          <td>
            <a href=""><i class="fa-solid fa-arrow-up-right-from-square fs-5"></i></a>
          </td>
          
        </tr>
        
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
const data = ref([]);
const user = ref({});

onMounted( async () =>{
  const storedUser = sessionStorage.getItem('user');
  if (storedUser) {
    user.value = JSON.parse(storedUser);
  }
  try {
    const url='';
    switch (user.value.perfil) {
      case 'gestor':
      const response_1 = await axios.get(
      `http://localhost/gestaoDeTarefas-master/src/backend/controllers/listManagerC.php?id_user=${user.value.id_utilizador}`
       );
        if (response_1.data.success) {
         data.value = response_1.data.tasks;
         }
        break;
    case 'administrador':
    const response_2 = await fetch('http://localhost/gestaoDeTarefas-master/src/backend/controllers/listTasks.php', {
        method: 'GET',
      });

      if (!response_2.ok) {
        throw new Error(`HTTP error! Status: ${response_2.status}`);
      }

      const result = await response_2.json();

      if (result.success) {
        data.value = result.data;
      } else {
        console.error(result.message);
      }
        break;
      default:
        break;
    }
      
    } catch (error) {
      console.error('Erro ao buscar dados:', error);
    }
});
</script>

<style scoped>
table {
  width: 100%;
}

a {
  text-decoration: none;
}
</style>