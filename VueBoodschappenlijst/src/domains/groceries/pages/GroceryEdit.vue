<script setup>
    import { watch } from 'vue';
    import { useRoute } from 'vue-router';
    import { addGrocery, getGroceryById } from '../store';
    import GroceryForm from './GroceryForm.vue';

    const route = useRoute()
    let grocery = {name: '', price: 0, amount: 0};

    watch(
    () => route.params.id,
    (newId) => {
        grocery = getGroceryById(newId);
    }
    );
</script>

<template>
    <GroceryForm @submit="addGrocery" :grocery="grocery" />
</template>

<style scoped>

</style>
