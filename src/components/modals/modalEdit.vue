<template>
  <div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-users-gear me-2"></i>Criar novo Colaborador</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row px-2">
            <div class="col-md-12 mb-2">
              <label for="" class="me-2 mb-2 fw-semibold">Nome do colaborador</label>
              <input type="text" v-model="nomeColaborador" @input="validateNome" :class="{'is-invalid': !validNome && nomeColaborador.length > 0, 'is-valid': validNome}" placeholder="Nome do colaborador" class="w-100"/>
              <div v-if="nomeColaborador.length > 0 && !validNome" class="invalid-feedback">
                O nome deve ter mais de três caracteres.
              </div>
            </div>

            <div class="col-md-12 mb-2">
              <label for="" class="me-2 mb-2 fw-semibold">Email</label>
              <input type="text" v-model="email" @input="validateEmail" :class="{'is-invalid': !validEmail && email.length > 0, 'is-valid': validEmail}" placeholder="Email" class="w-100"/>
              <div v-if="email.length > 0 && !validEmail" class="invalid-feedback">
                Por favor, insira um email válido.
              </div>
            </div>

            <div class="col-md-12 mb-2">
              <label for="" class="me-2 mb-2 fw-semibold">Número de telefone</label>
              <input type="text" v-model="numero" @input="validateNumero" :class="{'is-invalid': !validNumero && numero.length > 0, 'is-valid': validNumero}" placeholder="Número de telefone" class="w-100"/>
              <div v-if="numero.length > 0 && !validNumero" class="invalid-feedback">
                O número deve ter nove dígitos.
              </div>
            </div>

            <div class="col-md-7 mb-3">
              <label class="fw-semibold mb-1">Perfil de acesso</label> <br>
              <!-- <select v-model="perfil_acesso" class="custom-select w-100">
                <option v-for="(prioridade, index) in prioridades" :key="index" :value="prioridade.id">
                  {{ prioridade.nome_perfil }}
                </option>
              </select> -->
              <cSelect :opts="typeUser" v-model="perfil_acesso"/>
            </div>

            <div class="col-md-12 mb-2">
              <label for="" class="me-2 mb-2 fw-semibold">Senha</label>
              <input type="text" v-model="senha" class="w-100 d-none"/>
              <p>A senha será enviada automaticamente para o número do Colaborador após a criação.</p>
            </div>
          
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary fw-semibold" @click="criarColaborador" :disabled="!isFormValid" data-bs-dismiss="modal"><i class="fa-solid fa-users-gear me-1"></i>Criar colaborador</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import cSelect from "../inputs/cSelect.vue";
import axios from 'axios';

const nomeColaborador = ref('');
const email = ref('');
const numero = ref('');
const senha = ref('');
const perfil_acesso = ref(''); 
const prioridades = ref([]); 
const typeUser =ref([
  {val: "colaborador", name: 'Colaborador'},
  {val: "gestor", name: 'Gestor'},
  {val: "administrador", name: 'Administrador'},
]);

const validNome = ref(false);
const validEmail = ref(false);
const validNumero = ref(false);

const validateNome = () => {
  validNome.value = nomeColaborador.value.length > 3;
};

const validateEmail = () => {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  validEmail.value = emailRegex.test(email.value);
};

const validateNumero = () => {
  const numeroRegex = /^\d{9}$/;
  validNumero.value = numeroRegex.test(numero.value);
};

const isFormValid = computed(() => validNome.value && validEmail.value && validNumero.value);

function gerarSenha() {
  let senhaGerada = '';
  for (let i = 0; i < 6; i++) { 
    senhaGerada += Math.floor(Math.random() * 10); 
  }
  senha.value = senhaGerada;
}


onMounted(async () => {
  try {
    const response = await axios.get('http://localhost/gestaoDeTarefas-master/src/backend/controllers/listPerfil.php');
    console.log('Dados recebidos:', response.data.data);
    prioridades.value = response.data.data; 
  } catch (error) {
    console.error('Erro ao buscar prioridades:', error);
  }
});
const criarColaborador = async () => {
  gerarSenha();
  try {
    const response = await axios.post('http://localhost/gestaoDeTarefas-master/src/backend/controllers/addColaborador.php', {
      senha: senha.value,
      nomeColaborador: nomeColaborador.value,
      email: email.value,
      numero: numero.value,
      perfil_acesso: perfil_acesso.value 
    });
    
    if (response.data.success) {
      alert('Colaborador adicionado com sucesso!');
    } else {
      alert('Erro ao adicionar colaborador: ' + response.data.message);
    }
  } catch (error) {
    console.error('Erro ao enviar a requisição:', error);
  }
};
</script>

<style scoped>
.is-invalid {
  border-color: #dc3545;
}
.is-valid {
  border-color: #12e281;
}
.invalid-feedback {
  display: block;
}
</style>
