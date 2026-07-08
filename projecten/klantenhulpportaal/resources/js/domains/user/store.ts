import { ref } from "vue";
import { storeModuleFactory } from "../../services/store";
import { User } from "./types";

export const userStore = storeModuleFactory<User>("users");

export const currentUser = ref(<User>{});