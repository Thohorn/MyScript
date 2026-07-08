<script setup lang="ts">
import { useRouter } from 'vue-router';
import { getRequest } from './services/http';
import { onBeforeMount} from 'vue';
import { currentUser } from './domains/user/store';

const router = useRouter();

onBeforeMount(async() => {
    try{
        const checkUser = await getRequest('/me');
        // currentUser.value = checkUser.data;
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