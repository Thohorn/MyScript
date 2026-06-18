import { createRouter, createWebHistory } from 'vue-router';
import { userRoutes } from '../domains/user/routes';
import { ticketRoutes } from '../domains/tickets/routes';
import { getRequest } from '../services/http';

export const router = createRouter({
    history: createWebHistory(),
    routes: [...userRoutes, ...ticketRoutes],
});