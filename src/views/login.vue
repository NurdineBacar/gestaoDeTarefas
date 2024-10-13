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
                        <input type="text" name="nome" v-model="nome" class="w-100" placeholder="Usuario ou Email" />
                     </div>
                    <div class="col-md-12 mt-3">
                        <label for="" class="fw-bold mb-2 fs-5">Senha</label><br>
                        <input type="password" name ="senha" v-model="senha" icon="fa-solid fa-key" class="w-100" pholder="Senha"  />
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
import { ref, onMounted, defineEmits } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const emits = defineEmits(['updateUser']);

const nome = ref('');
const senha = ref('');

const login = async () => {
    console.log("Fazendo login");

    const data = {
        nome: nome.value,
        senha: senha.value
    };

    try {
        const response = await fetch('http://localhost/gestaoDeTarefas-master/src/backend/controllers/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const result = await response.json(); // Corrigido: Ler diretamente o JSON

        if (result.success) {
            router.push('/panel');
            sessionStorage.setItem('user',result.user);
            emits("updateUser", result.user); // Atualize os dados do usuário com os recebidos
        } else {
            alert(result.message);
        }

    } catch (error) {
        console.error("Erro ao fazer login:", error);
        alert("Erro ao fazer login. Por favor, tente novamente.");
    }
};


function teste(){
    router.push('/panel');
}

onMounted(async ()=>{

})




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