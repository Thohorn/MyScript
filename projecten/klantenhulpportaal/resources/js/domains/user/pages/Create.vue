<script setup lang="ts">
import { useRouter } from 'vue-router';
import Form from '../components/Form.vue';
import { ref } from 'vue';
import { User, userStore } from '../store';

const router = useRouter()

const newUser = ref<User>({
    name: '',
    surname: '',
    email: '',
    phone_number: '',
    role: '',
})

const handleSubmit = async (data: User) => {
    userStore.actions.create(data);
    router.push({name: 'user.login'});
}

</script>

<template>
    <Form :user="newUser" @submit="handleSubmit" />
</template>