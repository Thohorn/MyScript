<script setup>

import { getAllGroceries as products} from '../store.js';
import GroceriesTable from '../../../components/GroceriesTable.vue';

</script>

<template>
    <GroceriesTable :products="products"/>
</template>

<style scoped>

</style>
