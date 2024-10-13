<template>
        <select :value="modelValue" @change="onChange" class="w-100 text-center">
          <option value="">Selecione</option>
    <option v-for="opt in opts" :key="opt.val" :value="opt.val">
      {{ opt.name }}
    </option>
  </select>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

// Define props and emits
const props = defineProps({
  modelValue: String,
  opts: Array
});

const emit = defineEmits(['update:modelValue']);

// Handle change event
function onChange(event) {
  emit('update:modelValue', event.target.value);
}
</script>


<style scoped>
    select{
        outline: none;
        border: 1px solid gray;
        padding: 3px 0px;
        border-radius: 3px;
    }

    select:focus{
        border: 1px solid blue;
    }
</style>