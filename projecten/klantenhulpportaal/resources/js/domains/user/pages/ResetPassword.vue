<script setup lang="ts">
    import { ref } from 'vue';
    import { useRoute } from 'vue-router';
import { postRequest } from '../../../services/http';
import FormError from '../../../components/FormError.vue';

    const route = useRoute();

    const resetPassword = ref({
        email: "",
        password: "",
        passwordConfirmation: "",
        token: route.params.token,
    });

    const handleSubmit = async() => {
        postRequest('/resetpassword', resetPassword.value);            
    };

</script>

<template>
    <form @submit.prevent="handleSubmit">
        <label for="email" class="mr-4">email:</label>
        <input id="email" name="email" v-model="resetPassword.email" type="email" required>
        <FormError name="title" />

        <label for="password" class="mr-4">Wachtwoord:</label>
        <input id="password" name="password" type="password" v-model="resetPassword.password" required>

        <label for="password-confirmation" class="mr-4">Herhaal Wachtwoord</label>
        <input id="password-confirmation" name="password-confirmation" type="password" v-model="resetPassword.passwordConfirmation" required>

        <button type="submit">Wachtwoord resetten</button>
    </form>
</template>