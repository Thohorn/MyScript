<script setup lang="ts">
    import { ref } from 'vue';
    import { authenticateLoginRequest } from '../../../services/http';
    import FormError from '../../../components/FormError.vue';
    import ErrorMessage from '../../../components/errorMessage.vue';
    import { useRouter } from 'vue-router';

    const router = useRouter();

    const user = ref({
        email: "",
        password: "",
    });

    const handleSubmit = async() => {
        await authenticateLoginRequest(user.value);
        router.push({name: 'tickets.overview' });
    }

</script>

<template>
    <ErrorMessage />
    <h1>Login</h1>
    <form @submit.prevent="handleSubmit">
        <label for="email" class="mr-4">email:</label>
        <input id="email" name="email" v-model="user.email" required>
        <FormError name="email" />

        <label for="password" class="mr-4">Wachtwoord:</label>
        <input id="password" name="password" type="password" v-model="user.password" required>
        <FormError name="password" />

        <button type="submit">Inloggen</button>
    </form>

</template>