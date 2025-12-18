<script setup lang="ts">
import {getAllInventory as products} from '../store.ts';
import InventoryTable from '../components/InventoryTable.vue';
</script>

<template>
    <InventoryTable :products="products" />
</template>

<style scoped></style>
