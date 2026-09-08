<script setup lang="ts">
import { useRoute } from 'vue-router';
import { TicketStore } from '../store';
import { categoriesStore } from '../../categories/store';
import { userStore } from '../../user/store';

const route = useRoute();

TicketStore.actions.getAll();
categoriesStore.actions.getAll();
userStore.actions.getAll();

const ticket = TicketStore.getters.byId(Number(route.params.id));

</script>

<template>
    <div v-if="ticket">
        <div class="mb-1">
            <div class="text-xl font-bold">Title:</div>
            {{ ticket.title }}
        </div>
        <div class="mb-1">
            <div class="text-xl font-bold">Category:</div>
            {{ categoriesStore.getters.byId(ticket.category_id).value?.title  }}
        </div>
        <div class="mb-1">
            <div class="text-xl font-bold">Inhoud:</div>
            {{ ticket.body }}
        </div>
        <div class="mb-1">
            <div class="text-xl font-bold">Status:</div>
            {{ ticket.status }}
        </div>
        <div class="mb-1">
            <div class="text-xl font-bold">Gemaakt door:</div>
            {{ userStore.getters.byId(ticket.user_id).value?.name }} {{ userStore.getters.byId(ticket.user_id).value?.surname }}
        </div>
        <div class="mb-1">
            <div class="text-xl font-bold">Gemaakt op:</div>
            {{ ticket.created_at }}
        </div>
        <div class="mb-1">
            <div class="text-xl font-bold">Geupdate op:</div>
            {{ ticket.updated_at }}
        </div>
        <div v-if="ticket.assigned_to" class="mb-1">
            <div class="text-xl font-bold">Toegewezen aan:</div>
            {{ userStore.getters.byId(ticket.assigned_to).value?.name }} {{ userStore.getters.byId(ticket.assigned_to).value?.surname }}
        </div>
    </div>
    <!-- Responses -->
    <div>
        
    </div>
</template>