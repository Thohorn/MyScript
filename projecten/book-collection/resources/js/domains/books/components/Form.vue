<script setup>
import { ref } from 'vue';
import { fetchAuthors, getAllAuthors } from '../../authors/store';
import ErrorMessage from '../../../components/errorMessage.vue';
import FormError from '../../../components/FormError.vue';

// Fetch authors when component is mounted
fetchAuthors();

const props = defineProps({ book: Object });

const emit = defineEmits(['submit']);

const form = ref({ ...props.book });


const handleSubmit = () => emit('submit', form.value);
</script>

<template>
    <ErrorMessage />
    <form @submit.prevent="handleSubmit">
        <label>Titel:</label>
        <input v-model="form.title" type="text" required />
        <FormError name="title" />

        <label>Samenvatting:</label>
        <textarea v-model="form.summary" required></textarea>
        <FormError name="summary" />

        <label>Auteur:</label>
        <select v-model="form.author_id" required>
            <option v-for="author in getAllAuthors" :key="author.id" :value="author.id">
                {{ author.name }}
            </option>
        </select>
        <FormError name="author" />

        <button type="submit">Opslaan</button>
    </form>
</template>