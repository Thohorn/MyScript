<script setup>
    import { addGrocery } from '../store';
    import GroceryForm from '../components/GroceryForm.vue';

    const grocery = {id: 0, name: '', price: 0, amount: 0};



</script>

<template>
    <GroceryForm @submit="addGrocery" :grocery="grocery" />
</template>

<style scoped>

</style>
