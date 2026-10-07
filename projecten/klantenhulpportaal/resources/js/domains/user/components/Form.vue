<script setup lang="ts">
import { ref } from 'vue';
import ErrorMessage from '../../../components/errorMessage.vue';
import FormError from '../../../components/FormError.vue';
import { userRoles } from '../store.js';

    const props = defineProps({ user: Object, edit: Boolean });
    const form = ref({...props.user });

    if (!props.edit) {
        form.value.role = 'user';
    }

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
        <div v-if="props.edit" class="mt-2">
            <label>Rol: </label>
            <select v-model="form.role" required>
                <option v-for="role in userRoles" :key="role" :value="role">
                    {{ role }}
                </option>
            </select>
        </div>
        <div v-else>
            <div class="mt-2">
                <label>Wachtwoord: </label>
                <input v-model="form.password" type="password" required />
            </div>
            <div class="mt-2">
                <label>Herhaal wachtwoord: </label>
                <input v-model="form.password_confirmation" type="password" required />
            </div>
        </div>
        <div class="mt-2">
            <label>Telefoonnummer: </label>
            <input v-model="form.phone_number" type="text" required />
            <FormError name="phone_number" />
        </div>
        <div class="mt-5">
            <button type="submit">
                <span v-if="edit">Gebruiker opslaan</span>
                <span v-else>Gebruiker aanmaken</span>
            </button>
        </div>
    </form>
</template>