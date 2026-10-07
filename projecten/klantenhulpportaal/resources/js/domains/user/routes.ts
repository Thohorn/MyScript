import Create from "./pages/Create.vue";
import Edit from "./pages/Edit.vue";
import ForgotPassword from "./pages/ForgotPassword.vue";
import Login from "./pages/Login.vue";
import Overview from "./pages/Overview.vue";
import ResetPassword from "./pages/ResetPassword.vue";


export const userRoutes = [
    { path: '/user', component: Overview, name: 'user.overview', meta: { requiresAdmin: true }},    
    { path: '/user/edit/:id', component: Edit, name: 'user.edit', meta: { requiresAdmin: true }},    
    { path: '/user/create', component: Create, name: 'user.create'},
    { path: '/user/login', component: Login, name: 'user.login'},
    { path: '/user/forgotpassword', component: ForgotPassword, name: 'user.forgotpassword'},
    { path: '/user/resetpassword/:token', component: ResetPassword, name: 'user.resetpassword'},
]