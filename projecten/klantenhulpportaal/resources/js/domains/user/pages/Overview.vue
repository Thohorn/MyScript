<script setup lang="ts">
    import { userStore } from '../store';

    userStore.actions.getAll();

    const users = userStore.getters.all;

</script>

<template>
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
        </tr>
    </tbody>
</table>
</template>