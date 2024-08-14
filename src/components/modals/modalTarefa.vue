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
            <div class="col-md-12 mb-3">
              <label class="fw-semibold mb-1">Titulo da Tarefa</label>
              <inputs
                icon="fa-solid fa-heading"
                input-type="text"
                pholder="Titulo da Tarefa"
                class="w-100"
              />
            </div>
            <div class="col-md-6 mb-3">
              <label class="fw-semibold mb-1">Nivel de Prioridade</label>
              <cSelect :opts="[{val:'d',name:'d',},{val:'d',name:'d',},]"/>
            </div>
            <div class="col-md-6 mb-3">
              <label class="fw-semibold mb-1">Associar a uma entidade</label>
              <div class="d-flex flex-wrap gap-2" id="entidades">
                <input
                  type="radio"
                  class="btn-check"
                  name="options-base"
                  id="option5"
                  autocomplete="off"
                  checked
                />
                <label class="btn" for="option5">Nenhuma</label>

                <input
                  type="radio"
                  class="btn-check"
                  name="options-base"
                  id="option6"
                  autocomplete="off"
                />
                <label class="btn" for="option6">Tarefa</label>

                <input
                  type="radio"
                  class="btn-check"
                  name="options-base"
                  id="option7"
                  autocomplete="off"
                />
                <label class="btn" for="option7">Reclamacao</label>
                <input
                  type="radio"
                  class="btn-check"
                  name="options-base"
                  id="option8"
                  autocomplete="off"
                />
                <label class="btn" for="option8">Comunicacao</label>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label class="fw-semibold mb-1">Data de Conclusao</label>
              <inputs input-type="date" class="w-100" />
            </div>
            <div class="col-md-6 mb-3">
              <div class="d-flex gap-3 align-items-center">
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="flexRadioDefault"
                    id="flexRadioDefault2"
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
                    id="flexRadioDefault2"
                  />
                  <label class="form-check-label" for="flexRadioDefault2">
                    Equipe
                  </label>
                </div>
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="flexRadioDefault"
                    id="flexRadioDefault2"
                    checked
                  />
                  <label class="form-check-label" for="flexRadioDefault2">
                    Colaborador
                  </label>
                </div>
              </div>
              <div class="d-flex gap-2">
                <cSelect :opts="[{val:'d',name:'d',},{val:'d',name:'d',},]"/>
                <button class="btn btn-primary">Adicionar</button>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label class="fw-semibold mb-1">Local</label>
              <inputs
                icon="fa-solid fa-location"
                input-type="text"
                pholder="Local da Tarefa"
                class="w-100"
              />
            </div>
            <div class="col-md-6 mb-3 align-items-center">
             <div class="rounded w-100 d-flex gap-2 flex-wrap p-2" id="box-users">
                <span class="p-1 bg-primary text-white rounded">Raul Shelton <a href="" class="px-1 rounded bg-danger text-white"><i class="fa-solid fa-xmark"></i></a></span>
             </div>
            </div>
            <div class="col-md-12">
                <textarea name="" id="" cols="30" rows="5" class="" placeholder="Descricao.."></textarea>
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
          <button type="button" class="btn btn-primary"><i class="fa-solid fa-check me-1"></i>Criar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import inputs from "../inputs/input.vue";
import cSelect from "../inputs/cSelect.vue";
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