<script setup lang="ts">
import { useRoute } from 'vue-router';
import { TicketStore } from '../store';
import { categoriesStore } from '../../categories/store';
import { currentUser, userStore } from '../../user/store';
import { getAllResponsesByTicket, responseStore } from '../../responses/store';
import FormError from '../../../components/FormError.vue';
import { ref } from 'vue';
import AssignAdminForm from '../components/AssignAdminForm.vue';
import { Ticket } from '../types';
import StatusForm from '../components/StatusForm.vue';

const route = useRoute();

TicketStore.actions.getAll();
categoriesStore.actions.getAll();
userStore.actions.getAll();

const ticket = TicketStore.getters.byId(Number(route.params.id));

getAllResponsesByTicket(Number(route.params.id));
const responses = responseStore.getters.all;

const handleSubmit = async (data: Ticket) => {
    await TicketStore.actions.update(Number(route.params.id), data);
};

</script>

<template>
    <div class="text-xl font-bold">Ticket: </div>
    <div v-if="ticket" class="border-1 mt-2">
        <div class="mb-1">
            <div class="text-2xl font-extrabold">Status:</div>
            <span v-if="currentUser.role === 'admin'">
                <StatusForm :ticket="ticket"  @submit="handleSubmit" />
            </span>
            <span v-else>{{ ticket.status }}</span>
        </div>
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
            <div class="text-xl font-bold">Gemaakt door:</div>
            {{ userStore.getters.byId(ticket.user_id).value?.name }} {{ userStore.getters.byId(ticket.user_id).value?.surname }}
        </div>
        <div v-if="ticket.created_at" class="mb-1">
            <div class="text-xl font-bold">Gemaakt op:</div>
            {{ new Date(ticket.created_at).toLocaleDateString(undefined, {day:'numeric', month:'long', year:'numeric'}) }}
        </div>
        <div v-if="ticket.updated_at" class="mb-1">
            <div class="text-xl font-bold">Geupdate op:</div>
            {{ new Date(ticket.updated_at).toLocaleDateString(undefined, {day:'numeric', month:'long', year:'numeric'}) }}
        </div>
        <div class="mb-1">
            <div class="text-xl font-bold">Toegewezen aan:</div>
            <div v-if="currentUser.role === 'admin'">
                <AssignAdminForm :ticket="ticket"  @submit="handleSubmit" />
            </div>
            <div v-else-if="ticket.assigned_to">
                {{ userStore.getters.byId(ticket.assigned_to).value?.name }} {{ userStore.getters.byId(ticket.assigned_to).value?.surname }}
            </div>
            <div v-else>
                Nog niet toegewezen.
            </div>
        </div>
    </div>
    <!-- Responses -->
    <div>
        <div class="mt-5 text-xl font-bold">Reacties:</div>
        <div v-if="responses.length > 0" v-for="response in responses" class="mb-6 mt-2 border-1">
            <div>{{ response.body }}</div>
            <div>{{ userStore.getters.byId(response.user_id).value?.name }} {{ userStore.getters.byId(response.user_id).value?.surname }}
                <span v-if="response.created_at && response.created_at === response.updated_at" class="float-right">
                    {{ new Date(response.created_at).toLocaleDateString(undefined, {day:'numeric', month:'long', year:'numeric'}) }}
                </span>
                <span v-else-if="response.updated_at">(Aangepast) {{ new Date(response.updated_at).toLocaleDateString(undefined, {day:'numeric', month:'long', year:'numeric'}) }}</span>
            </div>
        </div>
        <div v-else>
            Nog geen reacties.
        </div>
    </div>
</template>