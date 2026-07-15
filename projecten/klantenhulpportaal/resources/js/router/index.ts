import { createRouter, createWebHistory } from 'vue-router';
import { userRoutes } from '../domains/user/routes';

export const router = createRouter({
    history: createWebHistory(),
    routes: [...userRoutes],
});