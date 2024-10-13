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

        <tbody class="fw-semibold">
            <tr v-for="item in filteredUserList" :key="item.id_utilizador">
                <td class="fs-6">
                    <div class="d-flex gap-2 justify-content-center align-items-center">
                        <img src="/img/do-utilizador.png" width="32px" class="rounded-circle" alt="">
                        <h6>{{ item.nome }}</h6>
                    </div>
                </td>
                <td>{{ item.numero_celular }}</td>
                <td>
                    {{ item.email }}
                </td>
                <td>
                    <span
                        class="badge bg-primary text-capitalize"
                        >
                        {{ item.perfil }}</span
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
             <a href="#"
            data-bs-toggle="modal"
            data-bs-target="#modalEdit"
              > <i class="fa-solid fa-edit fs-6"></i></a>

                        <a href=""><i class="fa-solid fa-trash fs-6"></i></a>
                    </div>
                </td>

                
            </tr>
        </tbody>
    </table>
    <modalEditUser/>
</template>


<script setup>
import { ref, onMounted, computed, defineProps } from "vue";
import modalEditUser from '../modals/modalEdit.vue';

const props = defineProps(['search','check']);
const data = ref([]);

onMounted(async ()=> {
    try {
      const response = await fetch('http://localhost/gestaoDeTarefas-master/src/backend/controllers/listColaborador.php', {
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
const filteredUserList = computed(() => {
  return data.value.filter(user => {
    const matchesSearch = !props.search || 
                          user.nome.toLowerCase().includes(props.search.toLowerCase());

    const matchesCheck = props.check === 'all' || 
                         (props.check === 'gestor' && user.perfil === "gestor") || 
                         (props.check === 'colaborador' && user.perfil === "colaborador");


    return matchesSearch && matchesCheck;
  });
});
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