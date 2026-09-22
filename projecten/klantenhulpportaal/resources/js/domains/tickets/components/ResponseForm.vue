<script setup lang="ts">
    import { ref } from 'vue';
    import ErrorMessage from '../../../components/errorMessage.vue';
    import FormError from '../../../components/FormError.vue';
    import { categoriesStore } from '../../categories/store.js';

    categoriesStore.actions.getAll();
    const categories = categoriesStore.getters.all;

    const props = defineProps({ response: Object });
    
    const emit = defineEmits(['submit']);
    
    const form = ref({...props.response });
    
    const handleSubmit = () => emit('submit', form.value);

</script>
<template>
    <ErrorMessage />
    <form @submit.prevent="handleSubmit">
        <label>Reactie:</label>
        <textarea v-model="form.body" type="text" required />
        <FormError name="body" />

        <button type="submit">Reactie opslaan</button>
    </form>
</template>