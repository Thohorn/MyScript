import { getRequest } from "../../services/http";
import { storeModuleFactory } from "../../services/store";
import { Response } from "./types";


export const responseStore = storeModuleFactory<Response>('responses');

export const getAllResponsesByTicket = async (ticket: number) => {
    const {data} = await getRequest(`responses/${ticket}`)
    if (!data) return
    responseStore.setters.setAll(data);
};