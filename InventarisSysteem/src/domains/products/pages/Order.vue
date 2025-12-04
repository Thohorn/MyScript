<script setup>
import {getToOrderInventory as products} from '../store.ts';
import OrderTable from '../components/OrderTable.vue';
</script>

<template>
    <OrderTable :products="products" />
</template>

<style scoped>
</style>
