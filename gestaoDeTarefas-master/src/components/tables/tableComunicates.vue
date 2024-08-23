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
      <tr v-for="item in data" :key="item.id_utilizador">
        <th><input type="checkbox" name="" id="" /></th>
        <td class="fs-6"><span class="badge bg-primary">Nova!</span></td>
        <td>
          <h6><i class="fa-regular fa-comment-dots me-1"></i> {{ item.titulo_comunicacao }}</h6>
        </td>
        
        <td>{{ item.tipo_comunicacao }}</td>
        <td>{{ item.localidade }}</td>
        <td>{{ item.data }}</td>
        <td>
          <div class="d-flex gap-2 justify-content-center align-items-center">
            <img
              src="/img/cat.jpg"
              width="30px"
              height="30px"
              alt=""
              class="rounded-circle"
            />
            <span class="fw-semibold text-secondary">{{ item.nome }}</span>
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


<script>
export default {
  data() {
    return {
      data: [],
    };
  },
  async created() {
    try {
      const response = await fetch('http://cursophp.com/gestaoDeTarefas-master/src/backend/controllers/listComunicates.php', {
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