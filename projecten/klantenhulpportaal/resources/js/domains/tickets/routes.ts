import Create from "./pages/Create.vue";
import Overview from "./pages/Overview.vue";


export const ticketsRoutes = [
    { path: '/tickets', component: Overview, name: 'tickets.overview'},
    { path: '/tickets/create', component: Create, name: 'tickets.create'},
]