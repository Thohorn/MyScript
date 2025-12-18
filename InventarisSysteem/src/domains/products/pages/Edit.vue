<script setup lang="ts">
import {useRoute} from 'vue-router';
import {updateProduct, getProductById} from '../store.ts';
import ProductForm from '../components/ProductForm.vue';

const route = useRoute();

const routeId = Number(route.params.id?.toString())

const product = getProductById(routeId);
</script>

<template>
    <ProductForm @submit="updateProduct" :product="product" />
</template>

<style scoped></style>
