<script setup>
import { onMounted } from 'vue';
import { deleteAuthor, fetchAuthors, getAllAuthors } from '../store';
import ErrorMessage from '../../../components/errorMessage.vue';


fetchAuthors();

</script>


<template>
    <ErrorMessage />
    <table>
        <thead>
            <tr>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="author in getAllAuthors" :key="author.id">
                <td>{{ author.name }}</td>
                <td><RouterLink :to="{ name: 'authors.edit', params: { id: author.id } }">Bewerk</RouterLink></td>
                <td><button @click="deleteAuthor(author.id)">Verwijder</button></td>
            </tr>
        </tbody>
    </table>
</template>