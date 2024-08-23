<template>
    <table class="rounded">
        <thead>
            <tr>
                <th>
                    Colaborador
                </th>
                <th>Contacto</th>
                <th>Email</th>
                <th>Tipo Colaborador</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="item in data" :key="item.id_utilizador">
                <td class="fs-6">
                    <div class="d-flex gap-2 justify-content-center">
                        
                        <h6>{{ item.nome }}</h6>
                    </div>
                </td>
                <td>{{ item.numero_celular }}</td>
                <td>
                    {{ item.email }}
                </td>
                <td>
                    <span
                        class="badge bg-primary"
                        >
                        {{ item.nome_perfil }}</span
                    >
                    
                </td>
                <td>
                    <span
                        class="badge bg-primary"
                        >Activo</span
                    >
                </td>
                <td>
                    <div class="d-flex gap-3 align-items-center">
                        <a href=""><i class="fa-solid fa-edit fs-6"></i></a>
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
      const response = await fetch('http://cursophp.com/gestaoDeTarefas-master/src/backend/controllers/listColaborador.php', {
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
    table{
        width: 100%;
        background: white;
        box-shadow: 0 0 7px rgba(0, 0, 0, 0.4);
        border-collapse: collapse;
    }

    th,td{
        padding: 10px 0;
        padding-left: 10px;
        text-align: center;
        font-size: 14px;
    }

    thead tr,tbody tr{
        border-bottom: 1px solid rgb(202, 201, 201);
    }

    tbody tr:last-child{
        border: none;
    }

    a{
        text-decoration: none;
    }
</style>