import { createRouter, createWebHistory, RouteLocationNormalized } from 'vue-router';
import { userRoutes } from '../domains/user/routes';
import { ticketsRoutes } from '../domains/tickets/routes';
import { currentUser } from '../domains/user/store';
import { categoriesRoutes } from '../domains/categories/routes';

export const router = createRouter({
    history: createWebHistory(),
    routes: [...userRoutes, ...ticketsRoutes, ...categoriesRoutes],
});

const openRoutes = ['user.login', 'user.forgotpassword', 'user.resetpassword'];

router.beforeEach(async (to: RouteLocationNormalized, from: RouteLocationNormalized) => {
    if(!currentUser.value.loggedIn &&  !openRoutes.includes(to.name)  ){
        return {name: 'user.login'};
    }
    if(to.meta.requiresAdmin && currentUser.value.role !== 'admin'){
        return {name: 'tickets.overview'};
    }
    return true;
});