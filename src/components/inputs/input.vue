<template>
    <label for="input" class="position-relative">
        <i :class="icon"></i>
        <input :type="inputType" :placeholder="pholder" class="" name="input" id="input"  :value="val" v-model="internalValue">
    </label>
</template>

<script setup>
import { defineProps, defineEmits, ref, watch } from 'vue';

// Definindo as props recebidas
const props = defineProps(['icon', 'inputType', 'pholder', 'modelValue','val']);

// Definindo o emit para emitir eventos de atualização
const emit = defineEmits(['update:modelValue']);

// Definindo uma ref para o valor interno do input
const internalValue = ref(props.modelValue);

// Observando mudanças no internalValue e emitindo um evento de atualização
watch(internalValue, (newValue, oldValue) => {
    emit('update:modelValue', newValue);
});

//Sincronizando o valor da prop modelValue com o valor interno
watch(() => props.modelValue, (newValue) => {
    internalValue.value = newValue;
});
</script>

<style scoped>
    input{
        outline: none;
        border: 1px solid gray;
        width: 100%;
        padding: 3px 0px;
        padding-left: 30px;
        border-radius: 3px;
    }

    input:focus{
        border: 1px solid blue;
    }

    i{
        position: absolute;
        top: 8px;
        left: 7px;
    }
</style>