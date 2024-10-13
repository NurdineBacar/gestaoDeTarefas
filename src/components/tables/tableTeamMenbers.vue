<template>
    <div>
      <table v-if="members.length > 0" class="table table-hover text-center">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Nome</th>
            <th scope="col">Celular</th>
            <th scope="col">Remover Menbro</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="member in members" :key="member.id_utilizador">
            <td>{{ member.id_utilizador }}</td>
            <td>{{ member.nome }}</td>
            <td>{{ member.numero_celular }}</td>
            <td>Remover</td>
          </tr>
        </tbody>
      </table>
      <p v-else class="text-center text-muted">Essa equipe não tem nenhum membro.</p>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted, watch } from 'vue';
  import axios from 'axios';
  
  const props = defineProps({
    idEquipe: Number
  });
  
  const members = ref([]);
  
  const fetchMembers = async () => {
    try {
      if (!props.idEquipe) {
        console.error('ID da equipe não está definido.');
        return;
      }
  
      const response = await axios.get(
        `http://localhost/gestaoDeTarefas-master/src/backend/controllers/viewMenbersTeam.php?id_equipe=${props.idEquipe}`
      );
  
      if (response.data.success) {
        members.value = response.data.data;
      } else {
        console.error('Erro ao buscar membros:', response.data.message);
        members.value = []; // Limpar a lista de membros em caso de erro
      }
    } catch (error) {
      console.error('Erro ao buscar membros:', error);
      members.value = []; // Limpar a lista de membros em caso de erro
    }
  };
  
  // Executa a busca quando o componente é montado ou quando a prop idEquipe muda
  onMounted(fetchMembers);
  watch(() => props.idEquipe, fetchMembers);
  </script>
  