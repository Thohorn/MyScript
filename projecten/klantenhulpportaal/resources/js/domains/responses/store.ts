import { getRequest } from "../../services/http";
import { storeModuleFactory } from "../../services/store";
import { Response } from "./types";


export const responseStore = storeModuleFactory<Response>('responses');

// export const responseStore = {
//     actions: {...baseStore.actions,
//         getAllResponsesByTicket = async (ticket: number) => {
//     const {data} = await getRequest(`responses/${ticket}`)
//     if (!data) return
//     responseStore.setters.setAll(data);
// };
//     },
//     getters: {...baseStore.getters},
// }


// store exploden en dan de functie toevoegen zoals hierboven. ipv wat hier beneden staat
export const getAllResponsesByTicket = async (ticket: number) => {
    const {data} = await getRequest(`responses/${ticket}`)
    if (!data) return
    responseStore.setters.setAll(data);
};