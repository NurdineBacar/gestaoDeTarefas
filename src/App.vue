<script setup>
import { RouterLink, RouterView, useRoute, useRouter } from 'vue-router'
import sidebar from "./components/sidebar.vue";
import { ref, onMounted } from "vue";
import axios from 'axios';


const route= useRoute();
const router =  useRouter();
const user= ref({});
// Função para atualizar o usuário autenticado
const updateUser = (userData) => {
  user.value = userData;
  sessionStorage.setItem('user', JSON.stringify(userData));
}

// Função de logout para remover o usuário
const logout = () => {
  user.value = null;
  sessionStorage.removeItem('user');
  location.href = '/';
};

// Restaura os dados do usuário a partir do sessionStorage quando a aba é aberta
onMounted( async () => {
  console.log(123)
  const storedUser = sessionStorage.getItem('user');
  if (storedUser) {
    user.value = JSON.parse(storedUser);
  }

  try{
    const response = await axios.get(
      `http://localhost/gestaoDeTarefas-master/src/backend/controllers/selectEquipeWhere.php?id_utilizador=${user.value.id_utilizador}`
    );

    if(response.data.success){
        console.log(response.data.data)
    }else{
      console.log("Erro ao  consultar dados");
    }
  }catch(error){
    console.log(error);
  }

});

</script>

<template>
  <div class="container-fluid">
    <div class="row py-2 ">
      <div class="col-md-auto" v-if="route.name !== '/'">
          <sidebar  :user="user" @logout="logout"/>
      </div>
      <div class="col-md">
        <router-view @updateUser="updateUser" :user="user"/>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
