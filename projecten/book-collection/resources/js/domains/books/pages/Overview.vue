<script setup>
import { onMounted } from 'vue';
import { fetchBooks, getAllBooks, deleteBook } from '../store';


fetchBooks();

</script>


<template>
        <table>
        <tr>
            <th>Title</th>
            <th>Summary</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <tr v-for="book in getAllBooks" :key="book.id">
            <td><RouterLink :to="{ name: 'books.show', params: { id: book.id } }" class="link">{{ book.title }}</RouterLink></td>
            <td>{{ book.summary }}</td>
            <td><RouterLink :to="{ name: 'books.edit', params: { id: book.id } }" class="link">Bewerk</RouterLink></td>
            <td><button @click="deleteBook(book.id)" class="link">Verwijder</button></td>
        </tr>
    </table>
</template>