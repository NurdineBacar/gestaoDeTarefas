<template>
        <select name="" id="" class="w-100">
            <option v-for="opt in opts" :key="opt" :value="opt.val">{{ opt.name }}</option>
        </select>
</template>

<script setup>
import { ref } from "vue";

defineProps(['opts'])
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