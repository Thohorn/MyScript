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
        <router-link :to="{name: 'user.overview'}">Gebruiker Overzicht</router-link> |
        <span v-if="currentUser.loggedIn"><button @click="handleLogout">Log uit</button></span>
        <span v-else><router-link :to="{name: 'user.login'}">Login</router-link></span>        
    </nav>

    <router-view></router-view>
</template>