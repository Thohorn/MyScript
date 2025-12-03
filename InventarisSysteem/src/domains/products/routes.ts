import CreateView from './pages/Create.vue';
import EditView from './pages/Edit.vue';
import OverviewView from './pages/Overview.vue';

export const routes = [
    {path: '/create', component: CreateView},
    {path: '/edit/:id', component: EditView},
    {path: '/overview', component: OverviewView},
];
