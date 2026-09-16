<script setup lang="ts">
import { useRouter } from 'vue-router';
import Form from '../components/Form.vue';
import { categoriesStore } from '../store.js';
import { Category } from '../types.js';

const router = useRouter(); 

const category: Category = {
    title: '',
}

const handleSubmit = async (data: Category) => {
    categoriesStore.actions.create(data);
    router.push({name: 'categories.overview'});
}

</script>

<template>
<Form :category="category"  @submit="handleSubmit"/>
</template>