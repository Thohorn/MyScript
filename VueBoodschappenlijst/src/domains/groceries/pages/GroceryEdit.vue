<script setup>
    import { watch } from 'vue';
    import { useRoute } from 'vue-router';
    import { updateGrocery, getGroceryById } from '../store';
    import GroceryForm from '../components/GroceryForm.vue';

    const route = useRoute()
    let grocery = getGroceryById(route.params.id).value;

    watch(
    () => route.params.id,
    (newId) => {
        grocery = getGroceryById(newId).value;
    }
    );
</script>

<template>
    <GroceryForm @submit="updateGrocery" :grocery="grocery" />
</template>

<style scoped>

</style>
