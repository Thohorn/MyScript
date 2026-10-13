<script setup lang="ts">
import { useRouter } from 'vue-router';
import Form from '../components/Form.vue';
import { TicketStore } from '../store.js';
import { Ticket } from '../types.js';
import { currentUser } from '../../user/store.js';

const router = useRouter(); 

const ticket: Ticket = {
    title: '',
    body: '',
    category_id: -1,
    user_id: currentUser.value.id,
}

// niet data gebruiken maar noemen wat het is. In dit geval ticket
const handleSubmit = async (data: Ticket) => {
    await TicketStore.actions.create(data);
    router.push({name: 'tickets.overview'});
}

</script>

<template>
<Form :ticket="ticket"  @submit="handleSubmit"/>
</template>