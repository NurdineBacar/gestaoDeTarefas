<template>
    <button :type="btnType" class="btn btn-primary fw-semibold" ><i :class="icon"></i>{{ name }}</button>
</template>


<script setup>
    defineProps(['icon','btnType','name']);
</script>

<style scoped>

</style>