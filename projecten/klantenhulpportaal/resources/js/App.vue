<script setup lang="ts">
import { useRouter } from 'vue-router';
import { currentUser, emptyCurrentUser, userStore } from './domains/user/store';
import { postRequest } from './services/http';
import { TicketStore } from './domains/tickets/store';
import { categoriesStore } from './domains/categories/store';
import { responseStore } from './domains/responses/store';

const router = useRouter();

const handleLogout = async() => {
    await postRequest('/logout');
    currentUser.value = emptyCurrentUser;
    
    TicketStore.actions.clearStore();
    userStore.actions.clearStore();
    categoriesStore.actions.clearStore();
    responseStore.actions.clearStore();

    router.push({ name: 'user.login' });
}

</script>

<template>
    <nav>
        <span v-if="currentUser.loggedIn">
            <span><router-link :to="{name: 'tickets.overview'}">Ticket Overzicht</router-link> | </span>
            <span><router-link :to="{name: 'tickets.create'}">Maak Ticket</router-link> | </span>
            <span v-if="currentUser.role === 'admin'"><router-link :to="{name: 'categories.overview'}">Category overzicht</router-link> | </span>
            <span><button @click="handleLogout">Log uit</button></span>
        </span>
        <span v-else><router-link :to="{name: 'user.login'}">Login</router-link></span>        
    </nav>

    <router-view></router-view>
</template>