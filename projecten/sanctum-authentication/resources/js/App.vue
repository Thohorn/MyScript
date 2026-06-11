<script setup lang="ts">
    import { ref } from 'vue';
    import { authenticateLoginRequest, getRequest } from './services/http';

    const user = ref({
        name: "",
        password: "",
    });

    const me = ref({
        name: "",
        email: "",
    });

    const handleSubmit = async() => {
        await authenticateLoginRequest(user.value);
        user.value.password = "";
    }

    const handleMe = async() =>
    {
        let request = await getRequest('/me');
        console.log(request.data);
        me.value = request.data
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

    <div class="gap-6 mt-4">
        <button @click="handleMe">Wie ben ik?</button>
        <p>
            Naam: {{ me.name }} <br>
            Email: {{ me.email }}
        </p>
    </div>

</template>