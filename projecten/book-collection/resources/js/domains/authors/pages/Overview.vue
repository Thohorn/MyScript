<script setup>
import { onMounted } from 'vue';
import { deleteAuthor, fetchAuthors, getAllAuthors } from '../store';
import ErrorMessage from '../../../components/errorMessage.vue';


fetchAuthors();

</script>


<template>
    <ErrorMessage />
        <table>
        <tr>
            <th>Name</th>
        </tr>
        <tr v-for="author in getAllAuthors" :key="author.id">
            <td>{{ author.name }}</td>
            <td><RouterLink :to="{ name: 'authors.edit', params: { id: author.id } }">Bewerk</RouterLink></td>
            <td><button @click="deleteAuthor(author.id)">Verwijder</button></td>
        </tr>
    </table>
</template>