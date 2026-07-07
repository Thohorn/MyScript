<script setup lang="ts">
import { useRouter } from 'vue-router';
import { getRequest } from './services/http';
import { onBeforeMount} from 'vue';
import { userStore } from './domains/user/store';

const router = useRouter();

onBeforeMount(async() => {
    try{
        // TODO:
        // Save to store
        // userStore.actions.getAll;
        const currentUser = await getRequest('/me');
        console.log(currentUser);
        // await getRequest('/me');
    }catch{
        router.push({ name: 'user.login' });
    }
});



</script>

<template>
    <nav>
        <router-link :to="{name: 'user.overview'}" class="link">user Overzicht</router-link>
    </nav>
    <router-view></router-view>
</template>