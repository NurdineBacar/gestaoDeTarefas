<template>
    <div class="container-sm mt-3">
        <div class="row justify-content-center" >
           <div class="col-md-4 py-5 px-5 mt-5" id="box">
                <div class="row ">
                    <div class="col-md-12 d-flex justify-content-between">
                            <div>
                                <h4 class="">Entrar</h4>
                                <cite class="text-secondary w-25">Welcome back! Please login <br> to your account</cite>
                            </div>
                            <h4>LOGO</h4>
                    </div>
                    
                    <div class="col-md-12 mt-4">
                        <label for="" class="fw-bold mb-2 fs-5">Usuario</label><br>
                        <inputs input-type="text" icon="fa-solid fa-user" class="w-100" pholder="Usuario ou Email"/>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="" class="fw-bold mb-2 fs-5">Senha</label><br>
                        <inputs input-type="password" icon="fa-solid fa-key" class="w-100" pholder="Senha"/>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="d-flex justify-content-end">
                            <a href="" class="">Esqueceu sua senha?</a>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <btn icon="fa-solid fa-arrow-right-to-bracket me-1" name="Entrar" @click="login" class="w-100"/>
                    </div>
                </div>
           </div>
        </div>
    </div>
</template>

<script setup>
import inputs from "../components/inputs/input.vue";
import btn from "../components/btn.vue";
import { ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

function login(){
    router.push('/panel');
}
</script>

<style scoped>
    #box{
        box-shadow: 0 0 8px rgba(0, 0, 0, .5);
        border-radius: 5px;
    }

    a{
        color: black;
    }

    a:hover{
        color: blue;
    }
</style>