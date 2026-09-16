<script setup lang="ts">
import { useRoute, useRouter } from 'vue-router';
import Form from '../components/Form.vue';
import { categoriesStore } from '../store.js';
import { Category } from '../types.js';

const route = useRoute();
const router = useRouter(); 

categoriesStore.actions.getAll();

const category = categoriesStore.getters.byId(Number(route.params.id));

const handleSubmit = async (data: Category) => {
    categoriesStore.actions.update(Number(route.params.id), data);
    router.push({name: 'categories.overview'});
}

</script>

<template>
<Form v-if="category" :category="category"  @submit="handleSubmit"/>
</template>