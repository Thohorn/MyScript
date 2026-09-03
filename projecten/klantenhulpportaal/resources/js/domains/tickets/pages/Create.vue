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

const handleSubmit = async (data: Ticket) => {
    TicketStore.actions.create(data);
    // router.push({name: 'tickets.overview'});
}

</script>

<template>
<Form :ticket="ticket"  @submit="handleSubmit"/>
</template>