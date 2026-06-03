<script setup lang="ts">
import { computed, ref } from 'vue';
import { useRoute } from 'vue-router';
import { fetchBooks, getBookById, fetchReviews, getAllReviews, createReview, deleteReview, getReviewById, updateReview } from '../store';
import ReviewForm from '../components/ReviewForm.vue';

fetchBooks();
fetchReviews();

const edit = ref("");

const route = useRoute();

const book = getBookById(route.params.id);

const reviews = computed(() => {
    const allReviews = getAllReviews;

    // const bookReviews = Object.entries(allReviews.value).filter((review) => review[1]['book_id'] === Number(route.params.id)).map((review) => review[1]);

    const bookReviews = [];
    for (let review in allReviews.value) {
        if (allReviews.value[review]['book_id'] === Number(route.params.id)) {
            bookReviews.push(allReviews.value[review]);
        }
    }
    
    return bookReviews;
});


const review = ref({
    title: '',
    body: '',
    book_id: route.params.id,
});

const reviewToEdit = ref({});

const handleCreateSubmit = async (data) => {
    await createReview(data);
};

const handleUpdateSubmit = async (data) => {
    await updateReview(data['id'], data);
    edit.value = '';
}

const handleDeleteClick = async (id) => {
    await deleteReview(id);
}

const handleEditClick = (reviewId, elementId) => {
    edit.value = elementId;
    reviewToEdit.value = getReviewById(reviewId).value;
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

        <div v-for="(review, index) in reviews" :key="review.id" :id="'Review' + index" class="book-review">
            <div v-if="edit === 'Review' + index">
                <ReviewForm :review="reviewToEdit" @submit="handleUpdateSubmit" />
            </div>
            <div v-else>
                <h3>Review: {{ review.title }}</h3>
                <p>{{ review.body }}</p>
                <span class="float-right"><button @click="handleEditClick(review.id, 'Review' + index)" class="link"> Aanpassen </button> | 
                    <button @click="handleDeleteClick(review.id)" class="link">Verwijder</button></span>
            </div>
        </div>
    </div>
</template>