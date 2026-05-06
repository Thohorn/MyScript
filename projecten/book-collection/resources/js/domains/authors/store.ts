import axios from 'axios';
import { ref, computed } from 'vue';
import { deleteRequest, getRequest, postRequest, putRequest } from '../../services/http';

//state
const authors = ref([]);

//getters
export const getAllAuthors = computed(() => authors.value);
export const getAuthorById = (id:number) => computed(() => authors.value.find(author => author.id == id));


//actions
export const fetchAuthors = async () => {
    const { data } = await getRequest('/authors');
    if (!data) return;
    authors.value = data;
}

export const createAuthor = async (newAuthor) => {
    const { data } = await postRequest('/authors', newAuthor);
    if (!data) return;
    authors.value = data;
}

export const updateAuthor = async (id:number, updatedAuthor) => {
    const { data } = await putRequest(`/authors/${id}`, updatedAuthor);
    if (!data) return;
    authors.value = data;
}

export const deleteAuthor = async (id:number) => {
    await deleteRequest(`/authors/${id}`);
    authors.value = authors.value.filter(author => author.id !== id);
}