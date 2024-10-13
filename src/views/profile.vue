<template>
    <div class="row mt-2">
        <div class="col-md-12">
            <h3>Perfil</h3>
        </div>
        <div class="col-md-8 mt-2 rounded pb-4 pt-3 px-5" id="box">
            <h5>Editar Perfil</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="" class="me-2 mb-2 fw-semibold">Usuario</label>
                    <inputs input-type="text"  pholder="Usuario" icon="fa-solid fa-user" class="w-100" :val="username"/>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="me-2 mb-2 fw-semibold">Email</label>
                    <inputs input-type="text"  pholder="Email@email.com" icon="fa-solid fa-envelope" class="w-100" :val="email"/>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="me-2 mb-2 fw-semibold">Primeiro Nome</label>
                    <inputs input-type="text"  pholder="Primeiro Nome" icon="fa-solid fa-signature" class="w-100" :val="fname"/>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="me-2 mb-2 fw-semibold">Apelido</label>
                    <inputs input-type="text"  pholder="Apelido" icon="fa-solid fa-signature" class="w-100" :val="lname"/>
                </div>
                <div class="col-md-6">
                    <label for="" class="me-2">Contacto</label>
                    <inputs input-type="text"  pholder="Primeiro Nome" icon="fa-solid fa-phone" class="w-100" :val="contact"/>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-6 mt-3">
                    <btn btn-type="submit" name="Editar" icon="fa-solid fa-edit me-1" class="w-50"/>
                </div>
            </div>
        </div>
        <div class="col-md rounded mx-3 mt-2" id="profile">
            <div class="row">
                <div class="col-md py-3">
                   <div class="ms-4 mt-5">
                    <img src="/img/cat.jpg" width="150px" height="150px" class="rounded-circle ms-5" alt="">
                    <label for="profile-img" id="edit" class="position-relative">
                        <input type="file" name="profile-img" id="profile-img">
                        <span class="rounded-circle"><i class="fa-solid fa-pencil"></i></span>
                    </label>
                   </div>
                  <div class="d-flex flex-column justify-content-center gap-2">
                    <span class="fw-bold text-center mt-2">{{ user.nome }}</span>
                   <span class="fw-semibold text-center bg-primary text-white rounded  mx-auto text-capitalize px-2">{{ user.perfil }}</span>
                   <!-- <a href="" class="text-center"> <i class="fa-brands fa-whatsapp fs-2"></i></a> -->
                  </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import inputs from "../components/inputs/input.vue";
import btn from "../components/btn.vue";
import { defineProps, ref, onMounted } from "vue";


const props =  defineProps(['user']);
const fname = ref('');
const lname = ref('');
const contact = ref('');
const email = ref('');
const username = ref('');
onMounted(() => {
    console.log(props.user)
    const nome_completo = props.user.nome.split(" ");
    fname.value = nome_completo[0];
    lname.value = nome_completo[1];
    email.value = props.user.email;
    contact.value = props.user.numero_celular;
    username.value = props.user.nome;
});
</script>

<style scoped>
    #box, #profile{
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
    }

    #box{
        height: 85vh;
    }

    #profile{
        height: 60vh;
    }

    #edit input{
        display: none;
    }

    #edit{
        cursor: pointer;
    }

    #edit span{
        background: rgba(148, 148, 148,.8);
        padding: 8px 10px;
        position: absolute;
        top: 28px;
        right: 10px;
    }   

    #edit span:hover{
        transition: .2s;
        background: rgba(148, 148, 148,1);
    }

</style>