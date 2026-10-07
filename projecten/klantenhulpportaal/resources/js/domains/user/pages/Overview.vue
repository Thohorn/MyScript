<script setup lang="ts">
    import { ref } from 'vue';
    import { User, userStore } from '../store';
    import ConfirmationModal from '../../../components/ConfirmationModal.vue';
    import ErrorMessage from '../../../components/errorMessage.vue';
import { TicketStore } from '../../tickets/store';

    userStore.actions.getAll();

    const showModal = ref(false);

    const users = userStore.getters.all;
    const currentUser = ref<User>();

    const showConfirmation = (user:User) => {
        currentUser.value = user;
        showModal.value = true;
    }

    const deleteUser = async() => {        
        showModal.value = false;      
        if (currentUser.value?.id){
            await userStore.actions.delete(currentUser.value?.id);
            await TicketStore.actions.clearStore();
            await TicketStore.actions.getAll();
        }    
    };

</script>

<template>
    <error-message />
    <div v-if="showModal"><confirmation-modal @canceled="showModal = false" @confirmed="deleteUser" body="Weet je zeker dat je de gebruiker wil verwijderen?" title="currentUser.title" /></div>
    <table class="user-overview-table">
        <thead>
            <tr>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>E-mailadres</th>
                <th>Rol</th>
                <th>Telfoonnummer</th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="users" v-for="user in users" :key="user.id">
                <td>{{ user.name }}</td>
                <td>{{ user.surname }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.role }}</td>
                <td>{{ user.phone_number }}</td>
                <td><router-link :to="{name: 'user.edit', params: {id: user.id}}">Aanpassen</router-link></td>
                <td><button @click="showConfirmation(user)">Verwijder</button></td>
            </tr>
        </tbody>
    </table>
</template>