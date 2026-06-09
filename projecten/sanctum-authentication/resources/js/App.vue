<script setup lang="ts">
    import { ref } from 'vue';
    import { postRequest } from './services/http';

    const user = ref({
        name: "",
        password: "",
    });


    const handleSubmit = () => {
        alert("Logging in?");
    }

</script>

<template>
    <h1>Login</h1>
    <form @submit.prevent="handleSubmit">
        <label for="name" class="mr-4">Gebruikersnaam:</label>
        <input id="name" name="name" v-model="user.name" required>

        <label for="password" class="mr-4">Wachtwoord:</label>
        <input id="password" name="password" type="password" v-model="user.password" required>

        <button type="submit">Inloggen</button>
    </form>
</template>