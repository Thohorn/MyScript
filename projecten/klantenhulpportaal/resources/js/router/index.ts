import { createRouter, createWebHistory } from 'vue-router';
import { userRoutes } from '../domains/user/routes';
import { ticketRoutes } from '../domains/tickets/routes';

export const router = createRouter({
    history: createWebHistory(),
    routes: [...userRoutes, ...ticketRoutes],
});