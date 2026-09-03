<script setup lang="ts">
import { useRouter } from 'vue-router';
import { currentUser, emptyCurrentUser } from './domains/user/store';
import { postRequest } from './services/http';

const router = useRouter();

const handleLogout = async() => {
    await postRequest('/logout');
    currentUser.value = emptyCurrentUser;
    router.push({ name: 'user.login' });
}

</script>

<template>
    <nav>
        <span v-if="currentUser.loggedIn">
            <span><router-link :to="{name: 'tickets.overview'}">Ticket Overzicht</router-link> | </span>
            <span><router-link :to="{name: 'tickets.create'}">Maak Ticket</router-link> | </span>
            <span><button @click="handleLogout">Log uit</button></span>
        </span>
        <span v-else><router-link :to="{name: 'user.login'}">Login</router-link></span>        
    </nav>

    <router-view></router-view>
</template>