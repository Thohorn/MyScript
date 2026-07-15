<script setup lang="ts">
    import { ref } from 'vue';
import { authenticateLoginRequest, getRequest } from '../../../services/http';


    const user = ref({
        email: "",
        password: "",
    });

    const handleSubmit = async() => {
        await authenticateLoginRequest(user.value);
        const checkUser = await getRequest('/me');
        console.log(checkUser);
    }
</script>


<template>
    <h1>Login</h1>
    <form @submit.prevent="handleSubmit">
        <label for="email" class="mr-4">email:</label>
        <input id="email" name="email" v-model="user.email" required>

        <label for="password" class="mr-4">Wachtwoord:</label>
        <input id="password" name="password" type="password" v-model="user.password" required>

        <button type="submit">Inloggen</button>
    </form>
</template>