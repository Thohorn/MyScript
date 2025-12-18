<script setup lang="ts">
import {addProduct} from '../store.ts';
import ProductForm from '../components/ProductForm.vue';

const product = {id: 0, name: '', actualAmount: 0, minimalAmount: 0};
</script>

<template>
    <ProductForm @submit="addProduct" :product="product" />
</template>

<style scoped></style>
