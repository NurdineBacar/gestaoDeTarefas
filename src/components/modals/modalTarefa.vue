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
        <!-- Modal Header -->
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">
            <i class="fa-solid fa-list-check me-1"></i>Criar Tarefa
          </h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
          <form @submit.prevent="registrarTarefa">
            <div class="row justify-content-center">
              <!-- Título da Tarefa -->
              <div class="col-md-12 mb-3">
                <label class="fw-semibold mb-1" for="titulo">Título da Tarefa</label>
                <input
                  type="text"
                  v-model="titulo"
                  name="titulo"
                  placeholder="Título da Tarefa"
                  class="form-control"
                  id="titulo"
                  required
                />
              </div>

              <!-- Nível de Prioridade -->
              <div class="col-md-6 mb-3">
                <label class="fw-semibold mb-1" for="prioridade">Nível de Prioridade</label>
                <cSelect
                  v-model="prioridade"
                  :opts="prioridadeOptions"
                  id="prioridade"
                />
              </div>

              <!-- Data de Conclusão -->
              <div class="col-md-6 mb-3">
                <label class="fw-semibold mb-1" for="dataConclusao">Data de Conclusão</label>
                <input
                  type="date"
                  class="form-control"
                  v-model="dataConclusao"
                  id="dataConclusao"
                  required
                />
              </div>

              <!-- Especificação da Tarefa -->
              <div class="col-md-12 mb-3">
                <label class="fw-semibold mb-1">Especificação da Tarefa</label>
                <div class="d-flex gap-3 flex-wrap">
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="alvo"
                      id="alvoTodos"
                      value="Todos"
                      v-model="alvo"
                      @change="updateOptions"
                      v-if="user.perfil !== 'gestor'"
                    />
                    <label class="form-check-label" for="alvoTodos" v-if="user.perfil !== 'gestor'">
                      Todos
                    </label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="alvo"
                      id="alvoEquipe"
                      value="Equipe"
                      v-model="alvo"
                      @change="updateOptions"
                      v-if="user.perfil !== 'gestor'"
                    />
                    <label class="form-check-label" for="alvoEquipe" v-if="user.perfil !== 'gestor'">
                      Equipe
                    </label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="alvo"
                      id="alvoColaborador"
                      value="Colaborador"
                      v-model="alvo"
                      @change="updateOptions"
                      checked
                    />
                    <label class="form-check-label" for="alvoColaborador">
                      Colaborador
                    </label>
                  </div>
                </div>

                <div class="d-flex gap-2 mt-2">
                  <select
                    v-model="selectedOption"
                    class="form-select"
                    @change="imprimirIds"
                    required
                  >
                    <option value="" disabled selected>Selecione</option>
                    <option v-for="option in currentOptions" :key="option.val" :value="option.val">
                      {{ option.name }}
                    </option>
                  </select>

                  <button type="button" class="btn btn-primary" @click="adicionarItem">
                    Adicionar
                  </button>
                </div>
              </div>

                 <!-- Itens Selecionados -->
            <div class="col-md-12 mb-3">
                <label class="fw-semibold mb-1">Selecionados</label>
                <div class="rounded w-100 d-flex gap-2 flex-wrap p-2 bg-light" id="box-users">
                  <span v-for="(item, index) in items" :key="item.val" class="p-1 bg-primary text-white rounded d-flex align-items-center">
                    {{ item.name }}
                    <button type="button" class="btn btn-sm btn-danger ms-2" @click="removerItem(index)" aria-label="Remover">
                      <i class="fa-solid fa-xmark"></i>
                    </button>
                  </span>
                </div>
            </div>

               <!-- Localização da Tarefa -->
               <div class="col-md-12 mb-3">
  <div class="col-md-6 mb-3">
    <label class="fw-semibold mb-1" for="provinceSelect">Selecione a província</label>
    <cSelect
      v-model="selectedProvince"
      :opts="provinceOptions"
      id="provinceSelect"
    />
  </div>

  <div class="col-md-6 mb-3">
    <label class="fw-semibold mb-1" for="districtSelect">Selecione o distrito</label>
    <cSelect
      v-model="selectedDistrict"
      :opts="districtOptions"
      id="districtSelect"
      :disabled="!selectedProvince"
    />
  </div>

  <label class="fw-semibold mb-1" for="local">Local</label>
  <input
    type="text"
    v-model="local"
    name="local"
    placeholder="Local da Tarefa"
    class="form-control"
    id="local"
    required
  />
</div>

              <!-- Descrição da Tarefa -->
              <div class="col-md-12 mb-3">
                <label class="fw-semibold mb-1" for="descricao">Descrição</label>
                <textarea
                  v-model="descricao"
                  name="descricao"
                  id="descricao"
                  cols="30"
                  rows="5"
                  class="form-control"
                  placeholder="Descrição da Tarefa"
                  required
                ></textarea>
              </div>
            </div>
          </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-outline-dark"
            data-bs-dismiss="modal"
          >
            Cancelar
          </button>
          <button
            type="submit"
            class="btn btn-primary"
            @click="registrarTarefa"
          >
            <i class="fa-solid fa-check me-1"></i>Criar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch, computed } from "vue";
import axios from "axios";
import cSelect from "../inputs/cSelect.vue";

// State Variables
const titulo = ref("");
const prioridade = ref("");
const dataConclusao = ref("");
const local = ref("");
const descricao = ref("");
const prioridadeOptions = ref([
  { val: "Alta", name: "Alta" },
  { val: "Media", name: "Média" },
  { val: "Baixa", name: "Baixa" },
]);

const alvo = ref("Colaborador");
const selectedOption = ref("");
const items = ref([]);
const user = ref({});

// Options based on 'alvo' and user profile
const options = ref([]);
const optionsGestor = ref([]);

// Computed property to determine current options
const currentOptions = computed(() => {
  return user.value.perfil === "gestor" ? optionsGestor.value : options.value;
});

// State for provinces and districts
const selectedProvince = ref("");
const selectedDistrict = ref("");
const provinceOptions = ref([
  { val: "Maputo", name: "Maputo" },
  { val: "Gaza", name: "Gaza" },
  { val: "Inhambane", name: "Inhambane" },
  { val: "Sofala", name: "Sofala" },
  { val: "Manica", name: "Manica" },
  { val: "Tete", name: "Tete" },
  { val: "Zambézia", name: "Zambézia" },
  { val: "Nampula", name: "Nampula" },
  { val: "Cabo_Delgado", name: "Cabo Delgado" },
  { val: "Niassa", name: "Niassa" },
  { val: "Maputo Cidade", name: "Maputo Cidade" },
]);

const provinces = ref({
  Maputo: ["Matola", "Boane", "Marracuene", "Manhiça", "Magude", "Moamba", "Namaacha"],
  Gaza: ["Xai-Xai", "Chókwè", "Chibuto", "Bilene", "Guijá", "Mandlakazi", "Massingir", "Chicualacuala", "Mabalane", "Mapai", "Limpopo"],
  Inhambane: ["Inhambane", "Maxixe", "Vilankulo", "Massinga", "Morrumbene", "Zavala", "Inharrime", "Jangamo", "Panda", "Homoíne", "Funhalouro", "Mabote"],
  Sofala: ["Beira", "Dondo", "Nhamatanda", "Búzi", "Chibabava", "Gorongosa", "Maríngué", "Muanza", "Caia", "Chemba", "Marromeu", "Machanga"],
  Manica: ["Chimoio", "Manica", "Gondola", "Barué", "Sussundenga", "Mossurize", "Machaze", "Macossa", "Tambara", "Vanduzi"],
  Tete: ["Tete", "Moatize", "Angónia", "Cahora-Bassa", "Chifunde", "Chiuta", "Dôa", "Macanga", "Magoé", "Marávia", "Mutarara", "Tsangano", "Zumbo"],
  Zambézia: ["Quelimane", "Alto Molócuè", "Chinde", "Gilé", "Gurúè", "Ile", "Inhassunge", "Lugela", "Maganja da Costa", "Milange", "Mocuba", "Mopeia", "Morrumbala", "Namacurra", "Namarroi", "Nicoadala", "Pebane"],
  Nampula: ["Nampula", "Angoche", "Eráti", "Ilha de Moçambique", "Lalaua", "Malema", "Meconta", "Mecubúri", "Memba", "Mogincual", "Mogovolas", "Moma", "Monapo", "Mossuril", "Muecate", "Murrupula", "Nacala", "Nacala-a-Velha", "Nacarôa", "Ribaué"],
  Cabo_Delgado: ["Pemba", "Ancuabe", "Balama", "Chiúre", "Ibo", "Macomia", "Mecúfi", "Meluco", "Mocímboa da Praia", "Montepuez", "Mueda", "Muidumbe", "Namuno", "Nangade", "Palma", "Quissanga"],
  Niassa: ["Lichinga", "Cuamba", "Lago", "Mandimba", "Marrupa", "Maúa", "Mavago", "Mecanhelas", "Mecula", "Metarica", "Muembe", "N'gauma", "Nipepe", "Sanga"],
  "Maputo Cidade": ["KaMpfumo", "Nhlamankulu", "KaMaxaquene", "KaMavota", "KaMubukwana", "KaTembe", "KaNyaka"],
});

const districtOptions = ref([]);

// Fetch user data from sessionStorage
const fetchUser = () => {
  const storedUser = sessionStorage.getItem("user");
  if (storedUser) {
    user.value = JSON.parse(storedUser);
    console.log("Usuário carregado:", user.value);
  } else {
    console.warn("Nenhum usuário encontrado na sessão.");
  }
};

// Fetch options based on 'alvo'
const updateOptions = async () => {
  let apiUrl = "";

  switch (alvo.value) {
    case "Todos":
      apiUrl =
        "http://localhost/gestaoDeTarefas-master/src/backend/controllers/listColaborador.php";
      break;
    case "Equipe":
      apiUrl =
        "http://localhost/gestaoDeTarefas-master/src/backend/controllers/selectEquipe.php";
      break;
    case "Colaborador":
      apiUrl =
        "http://localhost/gestaoDeTarefas-master/src/backend/controllers/selectColaborador.php";
      break;
    default:
      apiUrl =
        "http://localhost/gestaoDeTarefas-master/src/backend/controllers/listColaborador.php";
  }

  try {
    const response = await axios.get(apiUrl);
    if (response.data.success && Array.isArray(response.data.data)) {
      if (response.data.message !== "Nenhum dado encontrado") {
        if (alvo.value === "Equipe") {
          options.value = response.data.data.map((item) => ({
            val: item.id_equipe,
            name: item.nome_equipe,
          }));
        } else {
          options.value = response.data.data.map((item) => ({
            val: item.id_utilizador,
            name: item.nome,
          }));
        }
      } else {
        options.value = [];
      }
    } else {
      console.error("Formato de dados inesperado:", response.data);
      options.value = [];
    }
  } catch (error) {
    console.error("Erro ao buscar dados:", error);
    options.value = [];
  }
};

const onProvinceChange = () => {
  districtOptions.value = provinces.value[selectedProvince.value]?.map(district => ({
    val: district,
    name: district
  })) || [];
  selectedDistrict.value = ""; // Reset selected district when province changes
  local.value = ""; // Reset local field
};

const onDistrictChange = () => {
  local.value = selectedDistrict.value;
};

// Fetch manager-specific options
const fetchManagerOptions = async () => {
  if (user.value.perfil !== "gestor") return;

  const apiUrl = `http://localhost/gestaoDeTarefas-master/src/backend/controllers/listManagerC.php?id_user=${user.value.id_utilizador}`;

  try {
    const response = await axios.get(apiUrl);
    if (response.data.success && Array.isArray(response.data.members)) {
      optionsGestor.value = response.data.members.map((item) => ({
        val: item.id_utilizador,
        name: item.nome,
      }));
      console.log("Opções para gestor:", optionsGestor.value);
    } else {
      console.error("Erro ao buscar opções do gestor:", response.data.message);
      optionsGestor.value = [];
    }
  } catch (error) {
    console.error("Erro ao buscar opções do gestor:", error);
    optionsGestor.value = [];
  }
};

// Register Task Function
const registrarTarefa = async () => {
  try {
    const payload = {
      titulo: titulo.value,
      prioridade: prioridade.value,
      dataConclusao: dataConclusao.value,
      alvo: alvo.value,
      local: local.value,
      descricao: descricao.value,
      items: items.value.map((item) => item.val),
      id_utilizador: user.value.id_utilizador,
      responsavel:items.value[0].name,
    };

    const response = await axios.post(
      "http://localhost/gestaoDeTarefas-master/src/backend/controllers/addTask.php",
      payload
    );

    if (response.data.success) {
      alert("Tarefa adicionada com sucesso!");
      resetForm();
    } else {
      alert("Erro ao adicionar tarefa: " + response.data.message);
    }
  } catch (error) {
    console.error("Erro ao enviar a requisição:", error);
    alert("Erro ao adicionar tarefa.");
  }
};

// Add Item to Selected Items
const adicionarItem = () => {
  const currentSelected = currentOptions.value.find(
    (option) => option.val === selectedOption.value
  );

  if (currentSelected) {
    const isDuplicate = items.value.some(
      (item) => item.val === currentSelected.val
    );
    if (!isDuplicate) {
      items.value.push(currentSelected);
      selectedOption.value = ""; // Reset selection
    } else {
      alert("Este item já foi adicionado.");
    }
    console.log(items.value);
  } else {
    alert("Selecione um item válido.");
  }
};

// Remove Item from Selected Items
const removerItem = (index) => {
  items.value.splice(index, 1);
};

// Print Selected ID (for debugging)
const imprimirIds = () => {
  console.log("ID selecionado:", selectedOption.value);
};

// Reset Form Fields
const resetForm = () => {
  titulo.value = "";
  prioridade.value = "";
  dataConclusao.value = "";
  alvo.value = "Colaborador";
  local.value = "";
  descricao.value = "";
  items.value = [];
  selectedOption.value = "";
  updateOptions();
};

// Lifecycle Hook
onMounted(async () => {
  fetchUser();
  updateOptions();
  await fetchManagerOptions();
});

// Watchers
watch(alvo, () => {
  selectedOption.value = "";
  updateOptions();
});

watch(selectedProvince, onProvinceChange);
watch(selectedDistrict, onDistrictChange);
</script>


<style scoped>
.modal-dialog {
  margin-top: 5vh;
}

.btn-check {
  font-size: 14px;
}

textarea {
  outline: none;
  border: 1px solid rgb(202, 201, 201);
  width: 100%;
  padding: 0.5rem;
  border-radius: 4px;
  resize: vertical;
}

textarea:focus {
  border: 1px solid #0d6efd;
}

#box-users {
  background: rgb(242, 242, 242);
}

#box-users span {
  display: flex;
  align-items: center;
}

#box-users button {
  margin-left: 0.5rem;
  padding: 0.2rem 0.5rem;
}
</style>
