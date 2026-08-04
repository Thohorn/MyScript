<script setup lang="ts">
    import { useRouter } from 'vue-router';
    import { ref } from 'vue';
    import { authenticateLoginRequest, getRequest } from '../../../services/http';
    import ErrorMessage from '../../../components/errorMessage.vue';
    import FormError from '../../../components/FormError.vue';
    import { currentUser } from '../store';

    const router = useRouter();

    const user = ref({
        email: "",
        password: "",
    });

    const handleSubmit = async() => {
        await authenticateLoginRequest(user.value);
        const checkUser = await getRequest('/me');
        currentUser.value = {loggedIn: true, ...checkUser.data};
        router.push({name: 'tickets.overview'});
    }
</script>


<template>
    <h1>Login</h1>
    <ErrorMessage />
    <form @submit.prevent="handleSubmit">
        <label for="email" class="mr-4">email:</label>
        <input id="email" name="email" v-model="user.email" type="email" required>
        <FormError name="title" />

        <label for="password" class="mr-4">Wachtwoord:</label>
        <input id="password" name="password" type="password" v-model="user.password" required>

        <button type="submit">Inloggen</button>
    </form>
</template>