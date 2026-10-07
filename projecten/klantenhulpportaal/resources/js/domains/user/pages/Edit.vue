<script setup lang="ts">
    import { useRoute, useRouter } from 'vue-router';
    import { User, userStore } from '../store';
    import Form from '../components/Form.vue';

    const route = useRoute();
    const router = useRouter(); 

    userStore.actions.getAll();

    const user = userStore.getters.byId(Number(route.params.id));

    const handleSubmit = async (data: User) => {
        await userStore.actions.update(Number(route.params.id), data);
        router.push({name: 'user.overview'});
    }

</script>

<template>
    <div>{{ user.name }} {{ user.surname }} aanpassen</div>
    <Form :user="user" :edit="true" @submit="handleSubmit"/>
</template>