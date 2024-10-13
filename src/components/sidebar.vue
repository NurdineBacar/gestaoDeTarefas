<template>
   <div class="py-3 px-2 position-relative" id="box">
        <h2 class="ms-2 mb-3">LOGO</h2>

        <span class="text-secondary ms-2" id="menu">MENU</span>
        <div class="d-flex flex-column gap-1 mt-1">

            <router-link to="/panel" class="navlink d-flex justify-content-between px-2 py-2 rounded" v-if="user.perfil =='administrador' || user.perfil=='gestor'">
                <div>
                    <i class="fa-solid fa-home me-1"></i> 
                    Painel
                </div>
                <span class="badge bg-primary" >14</span>   
            </router-link>
            <router-link to="/tasks" class="navlink d-flex justify-content-between px-2 py-2 rounded" v-if="user.perfil=='administrador'">
                <div>
                    <i class="fa-solid fa-list-check me-1"></i> 
                    Tarefas
                </div>
                <span class="badge bg-primary" >14</span>   
            </router-link>
            <router-link to="/complaints" class="navlink d-flex justify-content-between px-2 py-2 rounded" v-if="user.perfil =='administrador' || user.perfil=='gestor'">
                <div>
                    <i class="fa-solid fa-face-sad-tear me-1"></i> 
                    Reclamacoes
                </div>
                <span class="badge bg-primary" >14</span>   
            </router-link>
            <router-link to="/comunicates" class="navlink d-flex justify-content-between px-2 py-2 rounded" v-if="user.perfil =='administrador' || user.perfil=='gestor'">
                <div>
                    <i class="fa-regular fa-comment-dots me-1"></i> 
                    Comunicacao
                </div>
                <span class="badge bg-primary" >14</span>   
            </router-link>
            <router-link to="/team-management" class="navlink d-flex justify-content-between px-2 py-2 rounded" v-if="user.perfil =='administrador'">
                <div>
                    <i class="fa-solid fa-users-gear me-1"></i> 
                    Gestao de Equipe
                </div>
                <span class="badge bg-primary" >14</span>   
            </router-link>
            <router-link to="/team-management-2" class="navlink d-flex justify-content-between px-2 py-2 rounded" v-if="user.perfil=='gestor'">
                <div>
                    <i class="fa-solid fa-users-gear me-1"></i> 
                    Gestao de Equipe
                </div>
                <span class="badge bg-primary" >14</span>   
            </router-link>
            <router-link to="/collaborators" class="navlink d-flex justify-content-between px-2 py-2 rounded" v-if="user.perfil =='administrador'">
                <div>
                    <i class="fa-solid fa-users me-1"></i> 
                    Coloboradores
                </div>
                <span class="badge bg-primary" >14</span>   
            </router-link>
            <router-link to="/report" class="navlink d-flex justify-content-between px-2 py-2 rounded" v-if="user.perfil =='administrador'">
                <div>
                    <i class="fa-solid fa-chart-column me-1"></i> 
                    Relatorio
                </div>
                <span class="badge bg-primary" >14</span>   
            </router-link>
            <router-link to="" class="navlink d-flex d-none justify-content-between px-2 py-2 rounded" v-if="user.perfil =='administrador' || user.perfil=='gestor'">
                <div>
                    <i class="fa-solid fa-home me-1"></i> 
                    Historico
                </div>
                <span class="badge bg-primary" >14</span>   
            </router-link>
            <hr>
        </div>

        <div class="position-absolute bottom-0 mb-2" id="lower-box">
            <a href="" class="fs-6 ms-2 fw-semibold" id="support"><i class="fa-solid fa-home me-1"></i> Suporte</a>
            <div class="d-flex align-items-center gap-2 mt-2  rounded py-2 px-2" id="lower-box-details">
                <img src="/img/cat.jpg" class="rounded-circle" width="30px" height="30px" alt="">
                <div class="d-flex flex-column gap-1">
                    <router-link to="/profile" id="name">{{ user.nome }}</router-link>
                    <span id="email">{{ user.email }}</span>
                </div>
                <a class="fs-5 ms-1 text-white" id="log" @click="$emit('logout')"><i class="fa-solid fa-arrow-right-to-bracket"></i></a>
            </div>
        </div>
   </div>
</template>

<script setup>
import { RouterLink } from 'vue-router';
import inputs from "./inputs/input.vue";
import { ref, defineProps, defineEmits, onMounted } from "vue";

const props =  defineProps(['user']);

</script>

<style scoped>
    #box{
        border-radius: 10px;
        height: 97vh;
        background: white;
        box-shadow: 0 0 10px rgba(0, 0, 0,.4);
        width: 220px;
    }

    #menu{
        font-size: 13px;
        font-weight: 600;
    }

    .navlink{
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
    }
    .router-link-active.navlink{
        background: rgb(202, 201, 201);
    }
    .navlink:hover{
        background: rgb(202, 201, 201);
    }

    #email{
        font-size: 11px;
    }
    #name{
        font-size: 14px;
        text-decoration: none;
        color: white;
        font-weight: 600;
    }
    #name:hover{
        text-decoration: underline;
        transition: .4s;
    }

    #log{
        color: black;
        cursor: pointer;
    }


    #support{
        text-decoration: none;
    }

    #lower-box{
       
        left: 3px;
    }

    #lower-box-details{
        background: blue;
        color: white;
    }
</style>