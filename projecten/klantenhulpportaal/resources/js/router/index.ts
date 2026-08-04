import { createRouter, createWebHistory, RouteLocationNormalized } from 'vue-router';
import { userRoutes } from '../domains/user/routes';
import { ticketsRoutes } from '../domains/tickets/routes';
import { currentUser } from '../domains/user/store';

export const router = createRouter({
    history: createWebHistory(),
    routes: [...userRoutes, ...ticketsRoutes],
});

router.beforeEach(async (to: RouteLocationNormalized, from: RouteLocationNormalized) => {
    if(!currentUser.value.loggedIn && to.name !== 'user.login'){
        return {name: 'user.login'};
    }
    return true;
});