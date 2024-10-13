<template>
  <table class="rounded">
    <thead>
      <tr>
        <th><input type="checkbox" name="" id="" /></th>
        <th></th>
        <th>Titulo</th>
        <th>Tipo de Comunicacao</th>
        <th>Local</th>
        <th>Data</th>
        <th>Usuario</th>
        <th></th>
      </tr>
    </thead>

    <tbody>
      <tr v-for="item in filteredComunicatesList" :key="item.id_utilizador">
        <th><input type="checkbox" name="" id="" /></th>
        <td class="fs-6"><span class="badge bg-primary">Nova!</span></td>
        <td>
          <h6><i class="fa-regular fa-comment-dots me-1"></i> {{ item.titulo }}</h6>
        </td>
        
        <td>{{ item.tipo_comunicacao }}</td>
        <td>{{ item.id_local == null || item.id_local == ''? 'Não especificado': item.id_local }}</td>
        <td>{{ item.data_comunicacao }}</td>
        <td>
          <div class="d-flex gap-2 justify-content-center align-items-center">
            <img
              src="/img/cat.jpg"
              width="30px"
              height="30px"
              alt=""
              class="rounded-circle me-1"
            />
            <span class="fw-semibold text-secondary text-capitalize">{{ item.nome }}</span>
          </div>
        </td>
        <td>
          <div class="d-flex gap-3 align-items-center">
            <a href=""><i class="fa-solid fa-eye fs-6"></i></a>
            <a href=""><i class="fa-solid fa-trash fs-6"></i></a>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script setup>
import { ref, onMounted,defineProps,computed } from "vue";

const data = ref([]);
const props = defineProps(['search','check','searchDate']);


onMounted(async ()=> {
  try {
      const response = await fetch('http://localhost/gestaoDeTarefas-master/src/backend/controllers/listComunicates.php', {
        method: 'GET',
      });

      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }

      const result = await response.json();

      if (result.success) {
        data.value = result.data;
      } else {
        console.error(result.message);
      }
    } catch (error) {
      console.error('Erro ao buscar dados:', error);
    }
});

// Filtrar tarefas com base na pesquisa e no estado selecionado
const filteredComunicatesList = computed(() => {
  return data.value.filter(comunic => {
    const matchesSearch = !props.search || 
                          comunic.titulo.toLowerCase().includes(props.search.toLowerCase());

    const matchesCheck = props.check === 'all' || 
                         (props.check === 'notread' && comunic.readed === 0) || 
                         (props.check === 'readed' && comunic.estado_tarefa === 1);

    const matchesDate = (props.searchDate == '') ||
                        (props.searchDate == comunic.data_comunicao);


    return matchesSearch && matchesCheck && matchesDate;
  });
});

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
</style>