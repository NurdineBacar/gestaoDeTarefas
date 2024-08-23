<template>
    <label for="input" class="position-relative">
        <i :class="icon"></i>
        <input :type="inputType" :placeholder="pholder" class="" name="input" id="input">
    </label>
</template>

<script setup>
    defineProps(['pholder','inputType','icon'])
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