<script setup lang="ts">
import { ref } from 'vue';


    const email = ref({
        email: "",
    });

    const handleSubmit = () => {

    }
</script>

<template>
    Vul je email adres in.
    <form @submit.prevent="handleSubmit">
        <label for="email" class="mr-4">email:</label>
        <input id="email" name="email" v-model="email.email" type="email" required>
        <FormError name="title" />

        <button type="submit">Wachtwoord vergeten</button>
    </form>
</template>