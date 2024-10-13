<template>
    <div class="row" id="box">
      <h5 class="pt-3" id="title">{{ titulo }}</h5>
      <div class="d-flex justify-content-end my-2">
        <i :class="icon+' fs-1'"></i>
      </div>
      <h3 id="value" :class="titulo != 'Tarefas'? 'mt-3':''">{{ val }}</h3>
      <div :class="'col-md '+ (titulo =='Tarefas'? 'ms-2': '')" id="chart">
        <span class="d-flex" v-if="titulo=='Tarefas'"><b class="me-2">Concluidos: </b> {{ concluido }}</span>
        <span class="" v-if="titulo=='Tarefas'"><b class="me-2">Pendentes: </b> {{ pendente }}</span>
      </div>
    </div>
  </template>
    
<script setup>
    import { ref, defineProps } from "vue";

    const props = defineProps(['titulo','val','pendente','concluido', 'icon'])
</script>
    
    <style scoped>
  #box {
    width: 180px;
    border-radius: 10px;
    background: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
    height: 180px;
  }
  
  #title {
    font-size: 13px;
    /* text-align: center; */
    margin-left: 7px;
  }
  span{
    font-size: 12px;
  }
  
  #value {
    font-size: 35px;
    /* text-align: right; */
    margin-left: 10px;
    margin-top: -15px;
  }
  
  #chart {
    margin-left: -5px;
    height: 80px;
  }
  
  canvas {
    max-width: 100%;
    height: auto;
  }
  </style>
    