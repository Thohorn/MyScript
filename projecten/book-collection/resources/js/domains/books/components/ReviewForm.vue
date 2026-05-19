<script setup>
import { ref } from 'vue';
import ErrorMessage from '../../../components/errorMessage.vue';
import FormError from '../../../components/FormError.vue';

const props = defineProps({ review: Object });

const emit = defineEmits(['submit']);

const form = ref({ ...props.review });


const handleSubmit = () => emit('submit', form.value);
</script>

<template>
    <ErrorMessage />
    <form @submit.prevent="handleSubmit">
        <div class="m-20">
            <label>Titel:</label>
            <input v-model="form.title" type="text" required />
            <FormError name="title" />
        </div>

        <div class="m-20">
            <label>Review:</label>
            <textarea v-model="form.body" required></textarea>
            <FormError name="body" />
        </div>
        <button type="submit" class="link">Opslaan</button>
    </form>
</template>