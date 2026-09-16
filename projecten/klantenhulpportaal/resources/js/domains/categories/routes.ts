import Create from "./pages/Create.vue";
import Edit from "./pages/Edit.vue";
import Overview from "./pages/Overview.vue";

export const categoriesRoutes = [
    {path: '/categories', component: Overview, name: 'categories.overview',  meta: { requiresAdmin: true }},
    {path: '/categories/create', component: Create, name: 'categories.create',  meta: { requiresAdmin: true }},
    {path: '/categories/edit/:id', component: Edit, name: 'categories.edit',  meta: { requiresAdmin: true }},
];