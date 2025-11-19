<script setup>
    import { useRoute } from 'vue-router';
    import { updateGrocery, getGroceryById } from '../store';
    import GroceryForm from '../components/GroceryForm.vue';

    const route = useRoute()
    let grocery = getGroceryById(route.params.id).value;

</script>

<template>
    <GroceryForm @submit="updateGrocery" :grocery="grocery" />
</template>

<style scoped>

</style>
