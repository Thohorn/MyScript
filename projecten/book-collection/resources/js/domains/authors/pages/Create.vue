<script setup>
import { ref } from 'vue';
import Form from '../components/Form.vue';
import { createAuthor } from '../store'
import { useRouter } from 'vue-router';

const router = useRouter();

const author = ref({
    name: '',
});

const handleSubmit = async (data) => {
    await createAuthor(data);
    router.push({name: 'authors.overview'});
};
</script>

<template>
    <div>
        <h2>Nieuwe author toevoegen</h2>
        <Form :author="author" @submit="handleSubmit" />
    </div>
</template>
