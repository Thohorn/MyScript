<script setup lang="ts">
import { categoriesStore } from '../../categories/store';
import { userStore } from '../../user/store';
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
        <tr v-if="tickets" v-for="ticket in tickets" :key="ticket.id">
            <td>{{ ticket.id }}</td>
            <td>{{ ticket.title }}</td>
            <td>{{ categoriesStore.getters.byId(ticket.category_id).value?.title }}</td>
            <td>{{ ticket.status }}</td>
            <td>{{ userStore.getters.byId(ticket.user_id).value?.name }} {{ userStore.getters.byId(ticket.user_id).value?.surname }}</td>
            <td v-if="ticket.created_at">{{ new Date(ticket.created_at).toLocaleDateString(undefined, {day:'numeric', month:'long', year:'numeric'}) }}</td>
            <td v-if="ticket.updated_at">{{ new Date(ticket.updated_at).toLocaleDateString(undefined, {day:'numeric', month:'long', year:'numeric'}) }}</td>
            <td v-if="ticket.assigned_to">{{ userStore.getters.byId(ticket.assigned_to).value?.name }} {{ userStore.getters.byId(ticket.assigned_to).value?.surname }}</td>
            <td v-else>Nog niet toegewezen</td>
        </tr>
    </tbody>
</table>
</template>