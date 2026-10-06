<script setup lang="ts">
    import { ref } from 'vue';
    import ErrorMessage from '../../../components/errorMessage.vue';
    import FormError from '../../../components/FormError.vue';

    const props = defineProps({ prop: Object, what: String });
    
    const emit = defineEmits(['submit']);
    
    const form = ref({...props.prop });
    
    const handleSubmit = () => {
        emit('submit', form.value);
        form.value.body = '';
    }

</script>
<template>
    <ErrorMessage />
    <form @submit.prevent="handleSubmit">
        <label>{{ props.what }}:</label>
        <textarea v-model="form.body" type="text" required />
        <FormError name="body" />

        <button type="submit">{{ props.what }} opslaan</button>
    </form>
</template>