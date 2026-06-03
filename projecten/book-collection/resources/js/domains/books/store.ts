import { storeModuleFactory } from '../../services/store';

const bookStore = storeModuleFactory('books');

export const fetchBooks = () => bookStore.actions.getAll();

export const getAllBooks = bookStore.getters.all;
export const getBookById = (id) => bookStore.getters.getById(id);

export const createBook = async (newBook) => {
    await bookStore.actions.create(newBook);
}

export const updateBook = async (id, updatedBook) => {
    await bookStore.actions.update(id, updatedBook);
}

export const deleteBook = async (id) => {
    await bookStore.actions.delete(id);
}

const reviewStore = storeModuleFactory('reviews');

export const fetchReviews = () => reviewStore.actions.getAll();

export const getAllReviews = reviewStore.getters.all;
export const getReviewById = (id) => reviewStore.getters.getById(id);

export const createReview = async (newReview) => {
    await reviewStore.actions.create(newReview);
}

export const updateReview = async (id, updatedReview) => {
    await reviewStore.actions.update(id, updatedReview);
}

export const deleteReview = async (id) => {
    await reviewStore.actions.delete(id);
}