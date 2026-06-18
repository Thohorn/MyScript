import { createRouter, createWebHistory } from 'vue-router';
import { userRoutes } from '../domains/user/routes';
import { ticketRoutes } from '../domains/tickets/routes';
import { getRequest } from '../services/http';

export const router = createRouter({
    history: createWebHistory(),
    routes: [...userRoutes, ...ticketRoutes],
});

// router.beforeEach(async (to, from) => {
//     if (to.meta.auth) {
//         try{
//             const user = await getRequest('/me');
//         }catch{        
//             return {
//             path: '/user',
//             query: { redirect: to.fullPath },
//             }
//         }
//     }
// })