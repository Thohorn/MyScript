<script setup lang="ts">
import { categoriesStore } from '../../categories/store';
import { currentUser, userStore } from '../../user/store';
import { TicketStore } from '../store';

TicketStore.actions.getAll();
userStore.actions.getAll();
categoriesStore.actions.getAll();

const tickets = TicketStore.getters.all;

</script>

<template> 
<table class="ticket-overview-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Titel</th>
            <th>Categorie</th>
            <th>Status</th>
            <th>Aangemaakt door</th>
            <th>Aangemaakt op</th>
            <th>Laatste update op</th>
            <th>Toegewezen aan</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="ticket in tickets" :key="ticket.id">
            <td>{{ ticket.id }}</td>
            <td>{{ ticket.title }}</td>
            <td>{{ categoriesStore.getters.byId(ticket.category).value.title }}</td>
            <td>{{ ticket.status }}</td>
            <td>{{ userStore.getters.byId(ticket.created_by).value.name }} {{ userStore.getters.byId(ticket.created_by).value.surname }}</td>
            <td>{{ new Date(ticket.created_at).toLocaleDateString(undefined, {day:'numeric', month:'long', year:'numeric'}) }}</td>
            <td>{{ new Date(ticket.updated_at).toLocaleDateString(undefined, {day:'numeric', month:'long', year:'numeric'}) }}</td>
            <td>{{ userStore.getters.byId(ticket.assigned_to).value.name }} {{ userStore.getters.byId(ticket.assigned_to).value.surname }}</td>
        </tr>
    </tbody>
</table>
</template>