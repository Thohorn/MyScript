<script setup lang="ts">
import { ref } from 'vue';
import { userStore } from '../../user/store';
import { TicketStatusus } from '../store';

userStore.actions.getAll();
const users = userStore.getters.all;

const props = defineProps({ticket: Object});

const emit = defineEmits(['submit']);

const form = ref({...props.ticket});

const handleSubmit = () => emit('submit', form.value);

</script>

<template>
    <form @submit.prevent="handleSubmit">
        <select v-model="form.status" required>
            <option v-for="(status, index) in TicketStatusus" :key="index" :value="status">
                {{ status }}
            </option>
        </select>
        <button type="submit">Status aanpassen</button>
    </form>
</template>