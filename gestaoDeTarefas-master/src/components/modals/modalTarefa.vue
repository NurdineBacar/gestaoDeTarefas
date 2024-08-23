<template>
  <div
    class="modal modal-lg fade"
    id="staticBackdrop"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-list-check me-1"></i>Criar Tarefa</h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="row justify-content-center">
            
            <!-- Input do titulo -->
            <div class="col-md-12 mb-3">
              <label class="fw-semibold mb-1">Titulo da Tarefa</label>
              <input
                icon="fa-solid fa-heading"
                 v-model="titulo"
                 name ="titulo"
                input-type="text"
                pholder="Titulo da Tarefa"
                class="w-100"
              />
            </div>

              <!-- Nivel de prioridade -->
              <div class="col-md-6 mb-3">
      <label class="fw-semibold mb-1">Nível de Prioridade</label>
      <cSelect 
        v-model="prioridade" 
        :opts="[
          {val:'Alta', name:'Alta'},
          {val:'Media', name:'Media'},
          {val:'Baixa', name:'Baixa'}
        ]"/> </div>

            <!-- Associar a uma entidade  -->
            <div class="col-md-6 mb-3">
              <label class="fw-semibold mb-1">Associar a uma entidade</label>
              <div class="d-flex flex-wrap gap-2" id="entidades">
                <input
                  type="radio"
                  class="btn-check"
                  name="options-base"
                  id="option5"
                  value="Nenhuma"
                  v-model="entidade"
                  autocomplete="off"
                  checked
                />
                <label class="btn" for="option5">Nenhuma</label>

                <input
                  type="radio"
                  class="btn-check"
                  name="options-base"
                  id="option6"
                  value="Tarefa"
                   v-model="entidade"
                  autocomplete="off"
                />
                <label class="btn" for="option6">Tarefa</label>

                <input
                  type="radio"
                  class="btn-check"
                  name="options-base"
                  id="option7"
                  value="Reclamacao"
                  v-model="entidade"
                  autocomplete="off"
                />
                <label class="btn" for="option7">Reclamacao</label>
                <input
                  type="radio"
                  class="btn-check"
                  name="options-base"
                  value="Comunicacao"
                  v-model="entidade"
                  id="option8"
                  autocomplete="off"
                />
                <label class="btn" for="option8">Comunicacao</label>
              </div>
            </div>

            <!-- Data de conclusao -->
            <div class="col-md-6 mb-3">
              <label class="fw-semibold mb-1">Data de Conclusão</label>
              <input type="date" class="w-100" v-model="dataConclusao" />
            </div>

            <!-- Especificando a tarefa -->
            <div class="col-md-6 mb-3">
              <div class="d-flex gap-3 align-items-center">
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    i
                    name="flexRadioDefault"
                    id="flexRadioDefault2"
                    value="Todos"
                    v-model="alvo"
                    @change="updateOptions"
                  />
                  <label class="form-check-label" for="flexRadioDefault2">
                    Todos
                  </label>
                </div>
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="flexRadioDefault"
                    id="flexRadioDefault3"
                    value="Equipe"
                    v-model="alvo"
                    @change="updateOptions"
                  />
                  <label class="form-check-label" for="flexRadioDefault3">
                    Equipe
                  </label>
                </div>
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    checked
                    name="flexRadioDefault"
                    id="flexRadioDefault4"
                    value="Colaborador"
                    v-model="alvo"
                    @change="updateOptions"
                    
                  />
                  <label class="form-check-label" for="flexRadioDefault4">
                    Colaborador
                  </label>
                </div>
              </div>

                <div class="d-flex gap-2">
  

                  <select v-model="selectedOption" class="custom-select" style="width: 100%;" @change="imprimirIds">
      <option v-for="(option, index) in options" :key="index" :value="option.val">
        {{ option.name }}
      </option>
    </select>

              <button class="btn btn-primary" @click="adicionarItem">Adicionar</button>
              </div>

              <!-- Localizacao da tarefa -->
            </div>
            <div class="col-md-6 mb-3">
              <label class="fw-semibold mb-1">Local</label>
              <input
                icon="fa-solid fa-location"
                input-type="text"
                pholder="Local da Tarefa"
                class="w-100"
                v-model="local"
              />
            </div>


            <div class="col-md-6 mb-3 align-items-center">
     <div class="rounded w-100 d-flex gap-2 flex-wrap p-2" id="box-users">
      <span v-for="(item, index) in items" :key="index" class="p-1 bg-primary text-white rounded">
        {{ item.name }} 
        <a href="#" class="px-1 rounded bg-danger text-white" @click="removerItem(index)">
          <i class="fa-solid fa-xmark"></i>
        </a>
      </span>
    </div>
          </div>  
            <!-- Area da descricao  -->
            <div class="col-md-12">
                <textarea v-model="descricao" name="" id="" cols="30" rows="5" class="" placeholder="Descricao.."></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-outline-dark"
            data-bs-dismiss="modal"
          >
            Cancelar
          </button>
          <button type="button" class="btn btn-primary"  @click="registrarTarefa"><i class="fa-solid fa-check me-1"></i>Criar</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import cSelect from "../inputs/cSelect.vue";
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';

// Definindo as variáveis de estado
const titulo = ref('');
const prioridade = ref('');
const entidade = ref();
const dataConclusao = ref();
const local = ref(); 
const descricao = ref();
const options = ref([]);
const selectedOption = ref('');
const alvo = ref('Colaborador');
const items = ref([]);


// Função para atualizar as opções com base na seleção do rádio

const updateOptions = async () => {
  let apiUrl = '';

  switch (alvo.value) {
    case 'Todos':
      apiUrl = 'http://cursophp.com/gestaoDeTarefas-master/src/backend/controllers/listColaborador.php'; 
      break;
    case 'Equipe':
      apiUrl = 'http://cursophp.com/gestaoDeTarefas-master/src/backend/controllers/selectEquipe.php'; 
      break;
    case 'Colaborador':
      apiUrl = 'http://cursophp.com/gestaoDeTarefas-master/src/backend/controllers/selectColaborador.php'; 
      break;
    default:
      apiUrl = 'http://cursophp.com/gestaoDeTarefas-master/src/backend/controllers/listColaborador.php'; 
  }


  try {
    const response = await axios.get(apiUrl);
    console.log('Resposta da API:', response.data);

    if (response.data.success && Array.isArray(response.data.data)) {
      options.value = response.data.data.map(item => ({
        val: item.id_utilizador,  
        name: item.nome
      }));
    } else {
      console.error('Formato de dados inesperado:', response.data);
    }
  } catch (error) {
    console.error('Erro ao buscar dados:', error);
  }
};

// Função para registrar a tarefa
const registrarTarefa = async () => {
  try {
    const response = await axios.post('http://cursophp.com/gestaoDeTarefas-master/src/backend/controllers/addTask.php', {
      titulo: titulo.value,
      prioridade: prioridade.value,
      entidade: entidade.value,
      dataConclusao: dataConclusao.value,
      alvo: alvo.value,
      local: local.value,
      descricao: descricao.value
    });

    if (response.data.success) {
      alert('Tarefa adicionada com sucesso!');
      console.log(titulo.value);
      console.log(prioridade.value);
      console.log(entidade.value);
      console.log(dataConclusao.value);
      console.log(alvo.value);
      console.log(local.value);
      console.log(descricao.value);
    } else {
      alert('Erro ao adicionar tarefa: ' + response.data.message);
    }
  } catch (error) {
    console.error('Erro ao enviar a requisição:', error);
    alert('Erro ao adicionar tarefa.');
  }
};

const adicionarItem = () => {
  const selected = options.value.find(option => option.val === selectedOption.value);
  if (selected) {
    // Verifica se o id_utilizador já está presente no array items
    const isDuplicate = items.value.some(item => item.val === selected.val);
    if (!isDuplicate) {
      items.value.push(selected);
    } else {
      console.warn('Este ID já foi adicionado.');
    }
  }
};

const imprimirIds = () => {
  console.log('ID selecionado:', selectedOption.value);
};


const removerItem = (index) => {
  items.value.splice(index, 1);
};

onMounted(() => {
  updateOptions();
});

// Atualiza as opções sempre que o valor de 'alvo' mudar
watch(alvo, updateOptions);

</script>
<style scoped>

.modal-dialog{
    margin-top: 0;
    margin-bottom: 0;
}
.btn-check {
  font-size: 9px;
}

textarea{
    outline: none;
        border: 1px solid rgb(202, 201, 201);
        width: 100%;
        padding: 3px 0px;
        padding-left: 30px;
        border-radius: 3px;
}

textarea:focus{
        border: 1px solid blue;
    }

#box-users{
  background: rgb(202, 201, 201);
}

#entidades label{
    font-size: 13px;
}
</style>




