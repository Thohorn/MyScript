<script setup>
import { ref } from 'vue';
import Form from '../components/Form.vue';
import { createBook } from '../store';
import { useRouter } from 'vue-router';

const router = useRouter();

const book = ref({
    title: '',
    summary: '',
    author_id: null
});

const handleSubmit = async (data) => {
    await createBook(data);
    router.push({name: 'books.overview'});
};
</script>

<template>
    <div>
        <h2>Nieuw boek toevoegen</h2>
        <Form :book="book" @submit="handleSubmit" />
    </div>
</template>
