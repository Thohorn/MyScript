<script setup lang="ts">
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import { fetchBooks, getBookById, createReview } from '../store';
import ReviewForm from '../components/ReviewForm.vue';

fetchBooks();
const route = useRoute();

const book = getBookById(route.params.id);

const review = ref({
    title: '',
    body: '',
});

const handleCreateSubmit = async (data) => {
    await createReview(data);
};


</script>

<template>
    <div class="center">
        <div class="book-summary">
            <h2>Title: {{ book.title }}</h2>
            {{ book.summary }}
        </div>

        <div class="add-review">
            <h3>Voeg een review toe</h3>
            <ReviewForm :review="review" @submit="handleCreateSubmit" />
        </div>

        <div v-for="review in book.reviews" class="book-review">
            <h3>Review: {{ review.title }}</h3>
            <p>{{ review.body }}</p>
        </div>
    </div>
</template>