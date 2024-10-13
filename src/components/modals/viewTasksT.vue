<template>
  <div
    class="modal fade mt-5"
    id="modalView-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">
            <i class="fa-solid fa-list-check me-1"></i> Detalhes da Tarefa
          </h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="row gap-1 px-4">
            <h5 class="text-center">{{ data?.titulo }}</h5>
            <hr />
            <div class="col-md-12">
              <table class="w-100">
                <tr>
                  <td>
                    <h6>Titulo</h6>
                    <span>{{ data?.titulo }}</span>
                  </td>
                  <td>
                    <h6>Referencia</h6>
                    <span class="badge bg-primary">{{ data?.referencia }}</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h6>Nivel de Prioridade</h6>
                    <span class="badge bg-warning">{{ data?.nivel_prioridade }}</span>
                  </td>
                  <td>
                    <h6>Estado da Tarefa</h6>
                    <span class="badge bg-primary">{{ data?.estado_tarefa }}</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h6>Data Esperada de Execução</h6>
                    <span>{{ data?.dataHora_Esperadaexecucao }}</span>
                  </td>
                  <td>
                    <h6>Data de Execução</h6>
                    <span>{{ data?.dataHora_execucao }}</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h6>Beneficiário</h6>
                    <span>{{ data?.id_beneficiario }}</span>
                  </td>
                  <td>
                    <h6>Local</h6>
                    <span>{{ data?.id_local }}</span>
                  </td>
                </tr>
              </table>
            </div>
            <hr />
            <div class="col-md-12 mb-1">
              <h6>Detalhes</h6>
              <span>{{ data?.detalhes?.length > 0 ? data.detalhes : "Sem descrição..." }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from "vue";

const props = defineProps(["data"]);
</script>

<style scoped>
.modal-dialog {
  margin-top: 0;
  margin-bottom: 0;
}

tr td {
  padding-bottom: 8px;
}

h6 {
  margin-bottom: 4px;
}

hr {
  border: 1px solid rgba(0, 0, 0, 0.1);
}

.modal-title {
  font-size: 18px;
  font-weight: 600;
}

.modal-body {
  padding: 20px;
}

.badge {
  font-size: 13px;
}

.text-center {
  text-align: center;
  font-weight: 600;
}

table {
  width: 100%;
  font-size: 13px;
}

td {
  padding: 10px;
}
</style>
