import { ref } from "vue";
import { storeModuleFactory } from "../../services/store";

interface User {
    id: number;
    name: string;
    surname: string;
    email: string;
    email_verified_at: string;
    phone_number: string;
    role: string;
    created_at: string;
    updated_at: string;
}

interface CurrentUser extends User {
    loggedIn: boolean;
}

export const userStore = storeModuleFactory<User>('user');
export const currentUser = ref<CurrentUser>({   
                                                loggedIn: false,
                                                id: -1,
                                                name: '',
                                                surname: '',
                                                email: '',
                                                email_verified_at: '',
                                                phone_number: '',
                                                role: '',
                                                created_at: '',
                                                updated_at: '',
                                            });