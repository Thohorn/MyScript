<script setup lang="ts">
import { useRoute } from 'vue-router';
import { fetchBooks, getBookById } from '../store';

fetchBooks();
const route = useRoute();

const book = getBookById(route.params.id);

</script>

<template>
        <h2>{{ book.title }}</h2>
        <div class="book-summary">
            {{ book.summary }}
        </div>
        <div v-for="review in book.reviews" class="book-review">
            <h3>{{ review.title }}</h3>
            <p>{{ review.body }}</p>
        </div>
</template>