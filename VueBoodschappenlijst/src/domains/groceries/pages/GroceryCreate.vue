<script setup>
    import { addGrocery } from '../store';
    import GroceryForm from './GroceryForm.vue';

    const grocery = {name: '', price: 0, amount: 0};



</script>

<template>
    <GroceryForm @submit="addGrocery" :grocery="grocery" />
</template>

<style scoped>

</style>
