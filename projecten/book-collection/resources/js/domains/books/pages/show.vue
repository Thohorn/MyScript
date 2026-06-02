<script setup lang="ts">
import { computed, ref } from 'vue';
import { useRoute } from 'vue-router';
import { fetchBooks, getBookById, fetchReviews, getAllReviews, createReview, deleteReview } from '../store';
import ReviewForm from '../components/ReviewForm.vue';

fetchBooks();
fetchReviews();

const route = useRoute();

const book = getBookById(route.params.id);
const reviews = computed(() => {
    let allReviews = getAllReviews;
    let bookReviews = [];
    for (let review in allReviews.value) {
        if (allReviews.value[review]['book_id'] === route.params.id) {
            bookReviews.push(review);
        }
    }
    console.log(bookReviews);
    return bookReviews;
});


const review = ref({
    title: '',
    body: '',
    book_id: route.params.id,
});

const handleCreateSubmit = async (data) => {
    await createReview(data);
    // fetchBooks();
};

const handleDeleteClick = async (id) => {
    await deleteReview(id);
    // fetchBooks();
}


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

        <div v-for="review in reviews" :key="review.id" class="book-review">
            <h3>Review: {{ review.title }}</h3>
            <p>
                {{ review.body }}
                <span class="float-right">Aanpassen | <button @click="handleDeleteClick(review.id)" class="link">Verwijder</button></span>
            </p>
                        
        </div>
    </div>
</template>