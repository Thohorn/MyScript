<script setup lang="ts">
    import { ref } from 'vue';
    import { useRoute } from 'vue-router';
import { postRequest } from '../../../services/http';
import FormError from '../../../components/FormError.vue';
import SuccesModal from '../../../components/SuccesModal.vue';
import ErrorMessage from '../../../components/errorMessage.vue';

    const route = useRoute();

    const resetPassword = ref({
        email: route.params.email,
        password: "",
        password_confirmation: "",
        token: route.params.token,
    });

    const showModal = ref(false);

    const handleSubmit = async() => {
        await postRequest('/resetpassword', resetPassword.value);
        showModal.value = true;
    };

</script>

<template>
    <ErrorMessage />
    <div  v-if="showModal"><SuccesModal title="Succesvol" body="Je wachtwoord is succesvol gereset" link="user.login" link-to="Login"/></div>
    <form @submit.prevent="handleSubmit">
        <label for="email" class="mr-4">email:</label>
        <input id="email" name="email" v-model="resetPassword.email" type="email" required>
        <FormError name="email" />

        <label for="password" class="mr-4">Wachtwoord:</label>
        <input id="password" name="password" type="password" v-model="resetPassword.password" required>
        <FormError name="password" />

        <label for="password_confirmation" class="mr-4">Herhaal Wachtwoord</label>
        <input id="password_confirmation" name="password_confirmation" type="password" v-model="resetPassword.password_confirmation" required>
        <FormError name="password_confirmation" />

        <button type="submit">Wachtwoord resetten</button>
    </form>
</template>