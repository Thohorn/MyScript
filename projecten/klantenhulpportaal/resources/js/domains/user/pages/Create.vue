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
    password: '',
    password_confirmation: '',
})

const handleSubmit = async (data: User) => {
    try {
        await userStore.actions.create(data);
        router.push({name: 'user.login'});
    } catch (error){
        return
    }
}

</script>

<template>
    <Form :user="newUser" :edit="false" @submit="handleSubmit" />
</template>