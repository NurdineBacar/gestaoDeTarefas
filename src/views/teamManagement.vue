<template>
  <div class="row mt-2">
    <div class="col-md-12">
      <h3>Gestao de Equipes</h3>
    </div>
    <div class="col-md-6">
      <inputs
        input-type="search"
        icon="fa-solid fa-magnifying-glass"
        pholder="Procurar equipe ou colaborador"
        class="w-75"
      />
    </div>
    <div class="col-md-6">
      <div class="d-flex gap-2 justify-content-end">
        <button class="btn btn-primary fw-semibold">
          <i class="fa-solid fa-plus me-1"></i> Tarefa
        </button>
        <button class="btn btn-primary fw-semibold">
          <i class="fa-solid fa-plus me-1"></i> Equipe
        </button>
      </div>
    </div>
    <div class="col-md-7 mt-2">
      <ul class="d-flex gap-5 align-items-center">
        <li class="fw-semibold">
          Casas:
          <span
            class="py-1 px-2 rounded-circle text-white text-center"
            data-state="all"
            >4</span
          >
        </li>
        <li class="fw-semibold">
          Activos:
          <span
            class="py-1 px-2 rounded-circle text-white text-center"
            data-state="active"
            >4</span
          >
        </li>
        <li class="fw-semibold">
          Inativos:
          <span
            class="py-1 px-2 rounded-circle text-white text-center"
            data-state="inactive"
            >4</span
          >
        </li>
      </ul>
    </div>
    <div class="col-md-5 align-self-end">
      <div class="d-flex justify-content-end">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
          <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked/>
          <label class="btn btn-outline-primary" for="btnradio1"><div class="fa-solid fa-grip"></div></label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off"/>
          <label class="btn btn-outline-primary" for="btnradio2"><i class="fa-solid fa-list"></i></label>
        </div>
      </div>
    </div>
    <div class="col-md-12 mt-1">
      <div class="row px-2" id="houses">
        <div class="col-md-3 mb-1">
          <task />
        </div>
        <!-- <div class="col-md-3 mb-3">
                    <addHouse/>
                </div> -->
      </div>
    </div>
    <!-- <houseModal/>
        <userModal/> -->
  </div>
</template>

<script setup>
import inputs from "../components/inputs/input.vue";
import cSelect from "../components/inputs/cSelect.vue";
import task from "../components/task.vue";
// import addHouse from "../components/addHouse.vue";
// import houseModal from "../components/houseModal.vue";
// import userModal from "../components/userModal.vue";
import { ref } from "vue";

let filtro = [
  { val: "activo", name: "activo" },
  { val: "inactivo", name: "intativo" },
];
</script>

<style scoped>
ul {
  padding: 0;
}
ul li {
  list-style: none;
}

ul li span {
  font-size: 12px;
}

#houses {
  padding: 5px 2px;
  height: 73vh;
  overflow-y: auto;
  scrollbar-width: thin;
  scrollbar-color: transparent transparent;
}

#nova {
  height: 40px;
  padding: auto;
  width: 100px;
}

span[data-state="active"] {
  background: green;
}
span[data-state="inactive"] {
  background: red;
}
span[data-state="all"] {
  background: blue;
}
</style>