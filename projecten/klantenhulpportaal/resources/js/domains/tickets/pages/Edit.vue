<script setup lang="ts">
import { useRouter, useRoute } from 'vue-router';
import Form from '../components/Form.vue';
import { TicketStore } from '../store.js';
import { Ticket } from '../types.js';

const route = useRoute();
const router = useRouter(); 

TicketStore.actions.getAll();

const ticket = TicketStore.getters.byId(Number(route.params.id));

const handleSubmit = async (data: Ticket) => {
    await TicketStore.actions.update(Number(route.params.id), data);
    router.push({name: 'tickets.overview'});
}

</script>

<template>
<Form v-if="ticket" :ticket="ticket"  @submit="handleSubmit"/>
</template>