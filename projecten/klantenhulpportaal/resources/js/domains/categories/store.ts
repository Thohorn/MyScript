import { storeModuleFactory } from "../../services/store";
import { Category } from "./types";

export const categoriesStore = storeModuleFactory<Category>('categories');