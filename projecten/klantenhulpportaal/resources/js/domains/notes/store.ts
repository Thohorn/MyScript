import { getRequest } from "../../services/http";
import { storeModuleFactory } from "../../services/store";
import { Note } from "./types";


export const noteStore = storeModuleFactory<Note>('notes');

export const getAllNotesByTicket = async (ticket: number) => {
    const {data} = await getRequest(`notes/${ticket}`)
    if (!data) return
    noteStore.setters.setAll(data);
};