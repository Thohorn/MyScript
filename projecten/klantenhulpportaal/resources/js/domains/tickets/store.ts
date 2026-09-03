import { storeModuleFactory } from "../../services/store";
import { Ticket } from "./types";


export const TicketStore = storeModuleFactory<Ticket>('tickets');