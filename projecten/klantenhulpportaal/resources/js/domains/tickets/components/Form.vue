<script setup lang="ts">
    import { ref } from 'vue';
    import ErrorMessage from '../../../components/errorMessage.vue';
    import FormError from '../../../components/FormError.vue';
    import { categoriesStore } from '../../categories/store';

    categoriesStore.actions.getAll();
    const categories = categoriesStore.getters.all;

    const props = defineProps({ ticket: Object });
    
    const emit = defineEmits(['submit']);
    
    const form = ref({...props.ticket });
    
    const handleSubmit = () => emit('submit', form.value);

</script>
<template>
    <ErrorMessage />
    <form @submit.prevent="handleSubmit">
        <label>Titel:</label>
        <input v-model="form.title" type="text" required />
        <FormError name="title" />

        <label>Categorie:</label>
        <select v-if="categories" v-model="form.category" required>
            <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.title }}
            </option>
        </select>
        <FormError name="category" />

        <label>Inhoud:</label>
        <textarea v-model="form.body" required />
        <FormError name="body" />

        <button type="submit">Ticket inleveren</button>
    </form>
</template>