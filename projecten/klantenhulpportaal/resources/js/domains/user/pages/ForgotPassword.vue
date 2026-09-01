<script setup lang="ts">
import { ref } from 'vue';
import { postRequest } from '../../../services/http';
import FormError from '../../../components/FormError.vue';
import ErrorMessage from '../../../components/errorMessage.vue';

    const email = ref({
        email: "",
    });

    const mailSend = ref(false);

    const userNotFound = ref('');

    const handleSubmit = async() => {
        try{
            await postRequest('/forgotpassword', email.value);
            alert('Als het mail adres overeenkomt met een account wordt er een mail gestuurd. Dit kan een paar minuten duren.');
        } catch(error){
            console.log(error);
            userNotFound.value = 'Dit email adres is niet gevonden. Misschien is er een typfout.'
        }
        
    }
</script>

<template>
    Vul je email adres in.
    <form @submit.prevent="handleSubmit">
        <div class="error-message">{{ userNotFound }}</div>
        <label for="email" class="mr-4">email:</label>
        <input id="email" name="email" v-model="email.email" type="email" required>
        <FormError name="title" />

        <button type="submit">Wachtwoord vergeten</button>
    </form>

</template>