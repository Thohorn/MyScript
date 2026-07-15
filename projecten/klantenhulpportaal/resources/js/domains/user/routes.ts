import Login from "./pages/Login.vue";
import Overview from "./pages/Overview.vue";


export const userRoutes = [
    { path: '/user', component: Overview, name: 'user.overview'},
    { path: '/user/login', component: Login, name: 'user.login'},
]