<script setup lang="ts">
    import { ref } from 'vue';
    import ErrorMessage from '../../../components/errorMessage.vue';
    import FormError from '../../../components/FormError.vue';

    const props = defineProps({ category: Object });
    
    const emit = defineEmits(['submit']);
    
    const form = ref({...props.category });
    
    const handleSubmit = () => emit('submit', form.value);

</script>
<template>
    <ErrorMessage />
    <form @submit.prevent="handleSubmit">
        <label>Titel:</label>
        <input v-model="form.title" type="text" required />
        <FormError name="title" />

        <button type="submit">Category opslaan</button>
    </form>
</template>