<script setup>
import {useRoute} from 'vue-router';
import {updateProduct, getProductById} from '../store.ts';
import ProductForm from '../components/ProductForm.vue';

const route = useRoute();
let product = getProductById(route.params.id).value;
</script>

<template>
    <ProductForm @submit="updateProduct" :product="product" />
</template>

<style scoped></style>
