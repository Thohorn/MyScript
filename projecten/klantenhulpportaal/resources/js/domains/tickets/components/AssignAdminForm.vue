<script setup lang="ts">
import { ref } from 'vue';
import { userStore } from '../../user/store';

userStore.actions.getAll();
const users = userStore.getters.all;

const props = defineProps({ticket: Object});

const emit = defineEmits(['submit']);

const form = ref({...props.ticket});

const handleSubmit = () => emit('submit', form.value);

</script>

<template>
    <form @submit.prevent="handleSubmit">
        <select v-model="form.assigned_to" required>
            <option v-for="admin in users.filter((user) => user.role === 'admin')" :key="admin.id" :value="admin.id">
                {{ admin.name }} {{ admin.surname }}
            </option>
        </select>
        <button type="submit">Administrator toewijzen</button>
    </form>
</template>