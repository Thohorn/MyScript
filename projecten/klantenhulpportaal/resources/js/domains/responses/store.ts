import { storeModuleFactory } from "../../services/store";
import { Response } from "./types";


export const categoriesStore = storeModuleFactory<Response>('responses');