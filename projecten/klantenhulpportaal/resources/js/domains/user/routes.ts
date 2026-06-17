import Create from "./pages/Create.vue";
import Edit from "./pages/Edit.vue";
import Overview from "./pages/Overview.vue";
import Show from "./pages/Show.vue";

export const userRoutes = [
    { path: '/user', component: Overview, name: 'user.overview' },
    { path: '/user/create', component: Create, name: 'user.create' },
    { path: '/user/:id', component: Show, name: 'user.show' },
    { path: '/user/:id/edit', component: Edit, name: 'user.edit' },
];