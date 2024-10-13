<template>
    <div
      class="modal modal-lg fade"
      id="modalView-1"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      tabindex="-1"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-list-check me-1"></i>Detalhes</h1>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="row mt-2">
                <div class="col-md-12">
                    <h4>Titulo: <span class="display-6 fs-3">{{ data.titulo }}</span></h4>
                    <p><b>Referencia:</b> <span class="badge bg-primary" >{{ data.referencia }}</span></p>
                    <p><b>NIvel de Prioridade:</b> <span class="badge bg-primary" >{{ data.nivel_prioridade }}</span></p>
                    <p><b>Estado da tarefa:</b> <span class="badge bg-primary" >{{ data.estado_tarefa }}</span></p>
                    <p>Data esperada da Execucao: {{ data.dataHora_Esperadaexecucao }}</p>
                    <p>Data  da Execucao: {{ data.dataHora_execucao }}</p>
                    <p>Beneficiario: {{ data.id_beneficiario }}</p>
                    <p>Local: {{ data.id_local }}</p>
                    <p>{{ data.detalhes }}</p>
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
   import { defineProps } from 'vue';

const props = defineProps(['data'])
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
  
  
  
  
  