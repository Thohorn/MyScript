<script setup lang="ts">
import { ref } from 'vue';
import ErrorMessage from '../../../components/errorMessage.vue';
import FormError from '../../../components/FormError.vue';
import { userRoles } from '../store.js';

    const props = defineProps({ user: Object });
    const form = ref({...props.user });

    const emit = defineEmits(['submit']);    
    const handleSubmit = () => emit('submit', form.value);

</script>
<template>
    <ErrorMessage />
    <form @submit.prevent="handleSubmit">
        <div class="mt-2">
            <label>Naam: </label>
            <input v-model="form.name" type="text" required />
            <FormError name="name" />
        </div>
        <div class="mt-2">
            <label>Achternaam: </label>
            <input v-model="form.surname" type="text" required />
            <FormError name="surname" />
        </div>
        <div class="mt-2">
            <label>E-mailadres: </label>
            <input v-model="form.email" type="email" required />
            <FormError name="email" />
        </div>
        <div class="mt-2">
            <label>Rol: </label>
            <select v-model="form.role" required>
                <option v-for="role in userRoles" :key="role" :value="role">
                    {{ role }}
                </option>
            </select>
        </div>
        <div class="mt-2">
            <label>Telefoonnummer: </label>
            <input v-model="form.phone_number" type="text" required />
            <FormError name="phone_number" />
        </div>
        <div class="mt-5">
            <button type="submit">Gebruiker opslaan</button>
        </div>
    </form>
</template>