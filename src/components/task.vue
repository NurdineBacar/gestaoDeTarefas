<template>
  <div id="main">
    <div
      id="box"
      class="rounded py-3 px-2"
      v-for="item in data"
      :key="item.id_equipe"
    >
      <div class="d-flex justify-content-between align-items-center">
        <h6>Equipe nº: {{ item.id_equipe }}</h6>
        <div class="d-flex gap-1">
          <span id="icon"><i class="fa-solid fa-users"></i></span>
          <span class="badge" data-status="active">Activo</span>
          <span hidden class="badge" data-status="active">{{ item.id_equipe }}</span>
        </div>
      </div>
      <span class="badge mb-2" id="moradores">Colaboradores</span>
      <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex" id="users">
          <img
            src="/img/cat.jpg"
            alt=""
            width="35px"
            height="35px"
            class="rounded-circle"
          />
          <img
            src="/img/cat.jpg"
            alt=""
            width="35px"
            height="35px"
            class="rounded-circle"
          />
          <div class="nUsers rounded-circle">
            <span class="fw-semibold text-white">+5</span>
          </div>
          <button
            class="rounded-circle mt-1 text-secondary"
            id="btn"
            @click="abrirModal(item.id_equipe, item.nome_equipe)"
            data-bs-toggle="modal"
            data-bs-target="#modalAddTeam"
          >
            <i class="fa-solid fa-plus"></i>
          </button>
        </div>
        <div class="d-flex">
          <a
            href="#"
            class=""
            @click="abrirModal(item.id_equipe, item.nome_equipe)"
            data-bs-toggle="modal"
            data-bs-target="#modalViewTeam"
          >
            <i class="fa-solid fa-eye"></i>
          </a>

          <a href="#"
           class=""
           @click="abrirModal(item.id_equipe, item.nome_equipe)"
            data-bs-toggle="modal"
            data-bs-target="#modalEditTeam"
           >
           <i class="fa-solid fa-pen-to-square"></i></a>
          <a href=""
            class=""
           @click="abrirModal(item.id_equipe, item.nome_equipe)"
            data-bs-toggle="modal"
            data-bs-target="#modalDeleteTeam"
           >
          <i class="fa-solid fa-trash"></i></a>
          
        </div>
      </div>
    </div>
    <modalAddTeam :idEquipe="selectedId" :nomeEquipe="nome_equipe" />
    <modalViewTeam :idEquipe="selectedId" :nomeEquipe="nome_equipe" />
    <modalEditTeam :idEquipe="selectedId" :nomeEquipe="nome_equipe" />
    <modalDeleteTeam :idEquipe="selectedId" :nomeEquipe="nome_equipe" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import modalAddTeam from '../components/modals/modalAddTeam.vue';
import modalViewTeam from '../components/modals/modalViewTeam.vue';
import modalEditTeam from '../components/modals/modalEditTeam.vue';
import modalDeleteTeam from '../components/modals/modalDeleteTeam.vue';
import axios from 'axios';

const data = ref([]);
const selectedId = ref(null);
const nome_equipe = ref('');

// Abrir modal e passar dados
const abrirModal = (idEquipe, nome) => {
  selectedId.value = idEquipe;
  nome_equipe.value = nome;
};

const fetchData = async () => {
  try {
    const response = await axios.get(
      'http://localhost/gestaoDeTarefas-master/src/backend/controllers/selectEquipe.php'
    );

    if (response.data.success) {
      data.value = response.data.data;
    } else {
      console.error(response.data.message);
    }
  } catch (error) {
    console.error('Erro ao buscar dados:', error);
  }
};

onMounted(fetchData);
</script>

<style scoped>

    #box{
        
        margin-right: 10px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0,.3),
                    0 0 5px rgba(163, 163, 163,.5);
    }

    img{
        border: 2px solid var(--text-white);
    }
    img:nth-child(2){
        position: relative;
        left: -10px;
    }

    #users{
        position: relative;
    }

   .nUsers{
        background: rgb(173, 172, 172);
        border: 2px solid var(--text-white);
        width: 35px;
        height: 35px;
        position: relative;
        left: -20px;
    }

    span[data-status="active"]{
        background:green;
    }

    span[data-status="inactive"]{
        background: gray;
    }

    .nUsers span{
        position: relative;
        top: 4px;
        left: 5px;
    }

    #btn{
        border-style: dashed;
        border-color: gray;
        height: 30px;
        width: 30px;
        margin-left: -13px;
        transition: .2s;
    }

    #btn:hover{
        background: rgba(179, 177, 177, 0.4);
    }

    #moradores{
        background: blue;
        color: white;
    }

    a{
        text-decoration: none;
        margin-right: 10px;
    }

    #icon,a{
        color: blue;
    }

    a:hover{
        color: blue;
    }
</style>