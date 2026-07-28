import { createApp } from "vue";
import App from "./App.vue";
import { router } from "./router/index.js";
import { getRequest } from "./services/http/index.js";
import { currentUser } from "./domains/user/store.js";

const app = createApp(App);

try{
    const loggedInUser = await getRequest('/me');
    currentUser.value = {loggedIn: true, ...loggedInUser.data};
} catch(error) {
    currentUser.value.loggedIn = false;
};

app.use(router);
app.mount("#app");

