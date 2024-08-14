<template>
    <div class="modal fade" id="modalTeam" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-users-gear me-2"></i>Criar Equipe</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row px-2">
          <div class="col-md-12 mb-2">
            <label for="" class="me-2 mb-2 fw-semibold">Nome da Equipe</label>
            <inputs input-type="text"  pholder="Nome da equipe" icon="fa-solid fa-user" class="w-100"/>
          </div>
          <div class="col-md-12 mb-2">
            <label for="" class="me-2 mb-2 fw-semibold">Calaborador</label>
            <div class="d-flex gap-2">
              <cSelect class="w-50"/>
              <btn btn-type="button" name="Adicionar" icon=""/>
            </div>
          </div>
          <div class="col-md-12 mb-2">
            <div class="d-flex gap-2 w-100 bg-secondary rounded p-2 flex-wrap" id="users">
              <span class="p-1 bg-primary text-white rounded">Raul Shelton <a href="" class="px-1 rounded bg-danger text-white"><i class="fa-solid fa-xmark"></i></a></span>
            </div>
          </div>
          <div class="col-md-12">
            <label for="" class="me-2 mb-2 fw-semibold">Gestor</label>
            <div class="d-flex">
              <cSelect/>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary fw-semibold"><i class="fa-solid fa-users-gear me-1"></i>Criar Equipe</button>
      </div>
    </div>
  </div>
</div>
</template>

<script setup>
    import inputs from "../inputs/input.vue";
    import cSelect from "../inputs/cSelect.vue";
    import btn from "../btn.vue";
</script>


<style scoped>
  #users{
    max-height: 100px;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: transparent transparent;
  }
</style>