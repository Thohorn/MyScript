import axios from 'axios';
import { ref, computed } from 'vue';
import { deleteRequest, getRequest, postRequest, putRequest } from '../../services/http';

// state
const books = ref([]);

// getters
export const getAllBooks = computed(() => books.value);
export const getBookById = (id:number) => computed(() => books.value.find(book => book.id == id));

// actions
export const fetchBooks = async () => {
    const {data} = await getRequest('/books');
    if(!data) return;
    books.value = data;
};

export const createBook = async (newBook) => {
    const {data} = await postRequest('/books', newBook);
    if(!data) return;
    books.value = data;
};

export const updateBook = async (id:number, updatedBook) => {
    const { data } = await putRequest(`/books/${id}`, updatedBook);
    if (!data) return;
    books.value = data;
};

export const deleteBook = async (id:number) => {
    await deleteRequest(`/books/${id}`);
    books.value = books.value.filter(book => book.id !== id);
};