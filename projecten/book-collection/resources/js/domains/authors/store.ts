import { storeModuleFactory } from "../../services/store";

const authorStore = storeModuleFactory('authors');

export const getAllAuthors = authorStore.getters.all;
export const getAuthorById = (id) => authorStore.getters.getById(id);

export const fetchAuthors = () => authorStore.actions.getAll();

export const createAuthor = async (newAuthor) => {
    await authorStore.actions.create(newAuthor);
}

export const updateAuthor = async (id, updatedAuthor) => {
    await authorStore.actions.update(id, updatedAuthor);
}

export const deleteAuthor = async (id) => {
    await authorStore.actions.delete(id);
}