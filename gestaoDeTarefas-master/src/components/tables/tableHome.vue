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
              
              <span>Raul Shelton</span>
            </div>
          </td>
          <td>20/10/2024</td>
          <td>
            <a href=""><i class="fa-solid fa-arrow-up-right-from-square fs-5"></i></a>
          </td>
        </tr>
        
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      data: [],
    };
  },
  async created() {
    try {
      const response = await fetch('http://cursophp.com/gestaoDeTarefas-master/src/backend/controllers/listTasks.php', {
        method: 'GET',
      });

      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }

      const result = await response.json();

      if (result.success) {
        this.data = result.data;
      } else {
        console.error(result.message);
      }
    } catch (error) {
      console.error('Erro ao buscar dados:', error);
    }
  },
};
</script>

<style scoped>
table {
  width: 100%;
}

a {
  text-decoration: none;
}
</style>